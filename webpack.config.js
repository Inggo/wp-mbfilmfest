const { VueLoaderPlugin } = require('vue-loader')

var MiniCssExtractPlugin = require('mini-css-extract-plugin'));

module.exports = {
  mode: 'production',
  module: {
    rules: [
      // ... other rules omitted
      {
        test: /\.css$/,
        use: [
          process.env.NODE_ENV !== 'production'
            ? 'vue-style-loader'
            : MiniCssExtractPlugin.loader,
          'css-loader'
        ]
      },
      {
        test: /\.js$/,
        loader: 'babel-loader'
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      }
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
    new MiniCssExtractPlugin({
      filename: 'style.css'
    })
  ]
}
