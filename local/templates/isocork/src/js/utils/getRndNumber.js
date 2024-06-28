export function getRndNumber(min, max, integer = true) {
  const rnd = Math.random() * (max - min + 1) + min;
  return integer ? Math.floor(rnd) : rnd
}