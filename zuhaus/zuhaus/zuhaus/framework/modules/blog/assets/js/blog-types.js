(function($) {
    "use strict";

    var blogChequered = {};
    mkdf.modules.blogChequered = blogChequered;

    blogChequered.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitBlogChequered();
        mkdfInitBlogChequeredLoadMore();
    }

    /**
     *  Init Blog Chequered
     */
    function mkdfInitBlogChequered(){
        var container = $('.mkdf-blog-holder.mkdf-blog-chequered');
        var masonry = container.children('.mkdf-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.mkdf-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }

    function mkdfInitBlogChequeredLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            mkdfInitBlogChequered();
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var blogMasonryGallery = {};
    mkdf.modules.blogMasonryGallery = blogMasonryGallery;

    blogMasonryGallery.mkdfOnDocumentReady = mkdfOnDocumentReady;
    blogMasonryGallery.mkdfOnWindowLoad = mkdfOnWindowLoad;
    blogMasonryGallery.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitBlogMasonryGallery();
        mkdfInitBlogMasonryGalleryAppearLoadMore();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitBlogMasonryGalleryAppear();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitBlogMasonryGallery();
    }

    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function mkdfInitBlogMasonryGallery() {
        var blogList = $('.mkdf-blog-holder.mkdf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.mkdf-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.mkdf-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                mkdfInitBlogMasonryGalleryAppear();
            });
        }
    }

    /**
     *  Animate blog masonry gallery type
     */
    function mkdfInitBlogMasonryGalleryAppear() {
        var blogList = $('.mkdf-blog-holder.mkdf-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.mkdf-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('mkdf-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('mkdf-appeared');
                },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

            });
        }
    }

    function mkdfInitBlogMasonryGalleryAppearLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            mkdfInitBlogMasonryGalleryAppear();
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var blogNarrow = {};
    mkdf.modules.blogNarrow = blogNarrow;

    blogNarrow.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).load(mkdfOnWindowLoad);


    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitBlogNarrowAppear();
        mkdfInitBlogNarrowAppearLoadMore();
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function mkdfInitBlogNarrowAppear() {
        var blogList = $('.mkdf-blog-holder.mkdf-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.mkdf-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('mkdf-appeared');
                    },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('mkdf-appeared');
                },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

            });
        }
    }

    function mkdfInitBlogNarrowAppearLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            mkdfInitBlogNarrowAppear();
        });
    }

})(jQuery);