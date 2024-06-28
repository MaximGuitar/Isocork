<?php
  namespace Placestart\Controller;

  use Bitrix\Main,
    Bitrix\Main\Engine\Controller,
    Bitrix\Sale\Basket,
    Bitrix\Sale,
    Bitrix\Main\Loader;
 
  Loader::includeModule('sale');
  Loader::includeModule('catalog');
   
  class ShopHelper extends Controller
  {
    /**
     * @return array
     */
    public function configureActions()
    {
      return [
        'example' => [
          'prefilters' => []
        ],
        'copyOrder' => [
          'prefilters' => []
        ]
      ];
    }
   
    /**
     * @param string $param2
     * @param string $param1
     * @return array
     */
    public static function exampleAction($param2 = 'qwe', $param1 = '')
    {
      return [
        'asd' => $param1,
        'count' => 300
      ];
    }

    public static function copyOrderAction($order_id){
      global $USER;

      $result = [
        'STATUS' => 'OK',
        'MESSAGE' => ''
      ];

      $ORDER_ID = intval($order_id); // ID текущего заказа

      if ($ORDER_ID <= 0){
        $result['STATUS'] = 'ERROR';
        $result['MESSAGE'] = 'Неправильный ID заказа';
        return $result;
      }
     
      $order = \Bitrix\Sale\Order::load($ORDER_ID);
      if (!$order){
        $result['STATUS'] = 'ERROR';
        $result['MESSAGE'] = 'Не удалось получить заказ';
        return $result;
      }


      // методы оплаты
      $paymentCollection = $order->getPaymentCollection();
      foreach ($paymentCollection as $payment) {
        $paySysID = $payment->getPaymentSystemId(); // ID метода оплаты
        $paySysName = $payment->getPaymentSystemName(); // Название метода оплаты
      }
       
      // службы доставки
      $shipmentCollection = $order->getShipmentCollection();
      foreach ($shipmentCollection as $shipment) {
        if($shipment->isSystem()) continue;
        $shipID = $shipment->getField('DELIVERY_ID'); // ID службы доставки
        $shipName = $shipment->getField('DELIVERY_NAME'); // Название службы доставки
      }


      // объект нового заказа
      $orderNew = \Bitrix\Sale\Order::create(SITE_ID, $USER->GetID());
       
      // код валюты
      $orderNew->setField('CURRENCY', $order->getCurrency());
       
      // задаём тип плательщика
      $orderNew->setPersonTypeId( $order->getPersonTypeId() );

      // создание корзины
      $basketNew = Basket::create(SITE_ID);
       
      // дублируем корзину заказа
      $basket = $order->getBasket();
       
      foreach ($basket as $key => $basketItem){
        $item = $basketNew->createItem('catalog', $basketItem->getProductId());
        $item->setFields([
          'QUANTITY' => $basketItem->getQuantity(),
          'CURRENCY' => $order->getCurrency(),
          'LID' => SITE_ID,
          'PRODUCT_PROVIDER_CLASS'=>'\CCatalogProductProvider',
        ]);
      }
       
      // привязываем корзину к заказу
      $orderNew->setBasket($basketNew);
       
      // задаём службу доставки
      $shipmentCollectionNew = $orderNew->getShipmentCollection();
      $shipmentNew = $shipmentCollectionNew->createItem();
      $shipmentNew->setFields([
        'DELIVERY_ID' => $shipID,
        'DELIVERY_NAME' => $shipName,
        'CURRENCY' => $order->getCurrency()
      ]);

      // пересчёт стоимости доставки
      $shipmentCollectionNew->calculateDelivery();
       
      // задаём метод оплаты
      $paymentCollectionNew = $orderNew->getPaymentCollection();
      $paymentNew = $paymentCollectionNew->createItem();
      $paymentNew->setFields([
        'PAY_SYSTEM_ID' => $paySysID,
        'PAY_SYSTEM_NAME' => $paySysName
      ]);
       
      // задаём свойства заказа
      $propertyCollection = $order->getPropertyCollection();
      $propertyCollectionNew = $orderNew->getPropertyCollection();
      foreach ($propertyCollection as $property){
        // получаем свойство в коллекции нового заказа
        $somePropValue = $propertyCollectionNew->getItemByOrderPropertyId( $property->getPropertyId() );
          
        // задаём значение свойства
        $somePropValue->setValue( $property->getField('VALUE') );
      }

      // сохраняем новый заказ
      $orderNew->doFinalAction(true);
      $rs = $orderNew->save();

      if ($rs->isSuccess()){
        $result['MESSAGE'] = 'Заказ успешно создан';
        $result['NEW_ORDER_ID'] = $orderNew->getId();
      }
      else{
        $result['STATUS'] = 'ERROR';
        $result['MESSAGE'] = $rs->getErrorMessages();
      }

      return $result;
    }
  }
?>