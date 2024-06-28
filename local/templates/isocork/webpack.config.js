const path = require("path")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const { WebpackManifestPlugin } = require("webpack-manifest-plugin")

const isDev = process.env.NODE_ENV === "development"

module.exports = {
	entry: "./src/js/app.ts",
	devtool: isDev ? "inline-cheap-module-source-map" : "source-map",
	watch: isDev,
	watchOptions: {
		ignored: /node_modules/,
	},
	mode: process.env.NODE_ENV,
	module: {
		rules: [
			{
				test: /\.ts(x)?$/,
				loader: "ts-loader",
				exclude: /node_modules/,
				options: {
					appendTsSuffixTo: [/\.vue$/],
				},
			},
			{
				test: /\.css$/i,
				use: [MiniCssExtractPlugin.loader, "css-loader"],
			},
			{
				test: /\.s[ac]ss$/i,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
			},
		],
	},
	resolve: {
		extensions: [".tsx", ".ts", ".js"],
	},
	output: {
		filename: "[name].[fullhash:6].js",
		path: path.resolve(__dirname, "dist"),
		clean: true,
		chunkFilename: "[name].[chunkhash:6].js",
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "[name].[fullhash:6].css",
			chunkFilename: "[name].[chunkhash:6].css",
		}),
		new WebpackManifestPlugin({
			publicPath: "dist",
		}),
	],
}
