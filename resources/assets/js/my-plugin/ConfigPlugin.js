var ConfigPlugin = {};
const host = "http://laravel.54.com:5000"
ConfigPlugin.install = function (Vue, options) {
    Vue.prototype.$config = {
        directory : {
            article_directory : 'uploads/article_thumb'
        },
        host : {
            img_host : host,
            api_host : host
        },
        url : {
            api : {
                article_store : host + '/api/articles'
            }
        }
    };
}

module.exports = ConfigPlugin;
