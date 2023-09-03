/**
 * Add-ons & Plugins 
 */

const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const autoprefixer = require('autoprefixer');
const AssetsPlugin = require('assets-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const path = require('path');


// Developer Mode
const DEV = (process.env.NODE_ENV === 'development');

/**
 * Configuiration
 */

module.exports = [
  {
    name: 'Public',
    mode: 'none',
    /* Control Compiling Message */
    stats: {
        colors: true,
        hash: true,
        version: false,
        timings: false,
        assets: false,
        chunks: false,
        modules: false,
        reasons: false,
        children: false,
        source: false,
        errors: true,             // Turn on If you want to see Error
        errorDetails: true,       // Turn on If you want to see Error Detail
        warnings: false,          // Turn on If you want to see Warning Detail
        publicPath: false
    },
    entry: './src/index.js',
    output: {
        filename: '[name].[hash:8].js',
        path: path.resolve(__dirname, 'build')
    },
    module: {
        rules: [
          {
            exclude:path.resolve(__dirname, "node_modules"),
            test: /\.js$/,
            use: {
              loader: "babel-loader",
            }
          },
          {
            test: /\.scss$/,
            use: [
                MiniCssExtractPlugin.loader,
                { loader: 'css-loader', options: { sourceMap: true, importLoaders: 1 } },
                { loader: 'sass-loader', options: { sourceMap: true } },
                {
                  loader: 'postcss-loader',
                  options: {
                    ident: 'postcss',
                    plugins: () => [
                      autoprefixer({
                        browsers: [
                          '>1%',
                          'last 5 versions',
                          'Firefox ESR',
                          'not ie < 9',                     //  Internet Explorer >:(
                        ],
                      }),
                    ],
                  },
                }
            ],
          }
        ]
      },
      /* Dev Enviroment Settings */
      devServer: {
          contentBase: [
            path.resolve(__dirname, "./*"),
            path.resolve(__dirname, "./views/*"),
            path.resolve(__dirname, "./views/tp/*")
          ],
          host: 'localhost',
          port: 3000,
          compress: true,
          stats: 'errors-only',
          open: true,
          hot: true,
          progress: true,
          watchContentBase: true,
          writeToDisk: true,                              // Turn to False if you want your content to server with Webpack Dev Server memory
          proxy: {
              '*': {
                target: 'http://localhost:80',            // Change the Port for your Localhost if required. 3000/8080/80
                // secure: false,                         // Use if you Testing HTTPS.
                changeOrigin: true
              }
          }
      },
      plugins: [
        new webpack.EnvironmentPlugin({
          NODE_ENV: 'development',                       // use 'development' unless process.env.NODE_ENV is defined
          DEBUG: false,
        }),
        !DEV && new CleanWebpackPlugin(['build'], {
            verbose: true,
            dry: false,
            exclude: ['bundle.js', 'bundle.css', 'assets.json']
        }),
        new MiniCssExtractPlugin({
            filename: "[name].[hash:8].css",
        }),
        new webpack.HotModuleReplacementPlugin(),
        new AssetsPlugin({
            filename: 'assets.json',
            path: path.resolve(__dirname, 'build')
        }),
      ]
  },
  {
    name: 'Admin',
    mode: 'none',
      /* Control Compiling Message */
      stats: {
          colors: true,
          hash: true,
          version: false,
          timings: false,
          assets: false,
          chunks: false,
          modules: false,
          reasons: false,
          children: false,
          source: false,
          errors: true,             // Turn on If you want to see Error
          errorDetails: true,       // Turn on If you want to see Error Detail
          warnings: false,          // Turn on If you want to see Warning Detail
          publicPath: false
      },
      entry: './src/admin/index.js',
      output: {
          filename: '[name].[hash:8].js',
          path: path.resolve(__dirname, 'build')
      },
        module: {
            rules: [
              {
                exclude:path.resolve(__dirname, "node_modules"),
                test: /\.js$/,
                use: {
                  loader: "babel-loader",
                }
              },
              {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: 'css-loader', options: { sourceMap: true, importLoaders: 1 } },
                    { loader: 'sass-loader', options: { sourceMap: true } },
                    {
                      loader: 'postcss-loader',
                      options: {
                        ident: 'postcss',
                        plugins: () => [
                          autoprefixer({
                            browsers: [
                              '>1%',
                              'last 5 versions',
                              'Firefox ESR',
                              'not ie < 9',                     //  Internet Explorer >:(
                            ],
                          }),
                        ],
                      },
                    }
                ],
              }
            ]
          },
          plugins: [
            new webpack.EnvironmentPlugin({
              NODE_ENV: 'development',                       // use 'development' unless process.env.NODE_ENV is defined
              DEBUG: false,
            }),
            !DEV && new CleanWebpackPlugin(['build'], {
                verbose: true,
                dry: false,
                exclude: ['admin.bundle.js', 'admin.bundle.css', 'admin.assets.json']
            }),
            new MiniCssExtractPlugin({
                filename: "[name][hash:8].css",
            }),
            new webpack.HotModuleReplacementPlugin(),
            new AssetsPlugin({
                filename: 'admin.assets.json',
                path: path.resolve(__dirname, 'build')
            }),
          ]
    }
]