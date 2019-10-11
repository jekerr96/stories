let Path = require('path');
const Fs = require('fs');
const Webpack = require('webpack');

module.exports = () => {
    let moduleConf = {
        context: __dirname + '/js/controllers/pages',
        entry: {main: './js/pages/main.js'},
        output: {
            path: Path.resolve(__dirname, "js/bundle"),
            publicPath: './js/bundle/',
            filename: '[name].bundle.js?[chunkhash]',
            chunkFilename: '[name].chunk.js?[chunkhash]',
        },
        mode: 'development',
        plugins: [
            new Webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
            }),
        ]
    };

    Fs.readdirSync(moduleConf.context).map(file => {
        let partFile = file.split('.')[0];

        if (partFile !== 'base') {
            moduleConf.entry[partFile] = `./${partFile}`;
        }
    });

    return moduleConf;
};