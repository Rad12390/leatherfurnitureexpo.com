var player, product_player;
function onYouTubePlayerAPIReady() {

    if ($('#iframeV').length) {
        player = new YT.Player('iframeV', {
            videoId: 'WGISykC3_PE',
            events: {}
        });
    }
    if ($('#product-iframeV').length) {
        product_player = new YT.Player('product-iframeV', {
            height: '98%',
            width: '98%',
            videoId: $youtubelink,
            events: {}
        });
    }
}


$(document).ready(function () {

    $('.requestSwatch a, .callforprice a').on({

        click: function (e) {

            var pageURL = $(this).data('url');
            var title = $(this).data('title');
            var width = $(this).data('width');
            var height = $(this).data('height')
            var left = (screen.width / 2) - (width / 2);
            var top = (screen.height / 2) - (height / 2);
            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + width + ', height=' + height + ', top=' + top + ', left=' + left);

        }
    });


    $('.cart input').on({
        click: function (e) {
            $('#form-bundle-addtocart').submit();

        }
    });

    $('.product-attachment a').on({
        click: function (e) {
            window.location = $(this).data('location');

        }
    });

    $('.external_link a').on({
        click: function (e) {
            window.open($(this).data('external-link'));
        }
    });


    $('.option-image .imageColorBox a').on({

        click: function (e) {
            var $optionName = $(this).data('option-name');
            Tip($(this).parents(".imageColorBox").find(".color_on_hover").html());
            $("#imageName").text($optionName);
        },

        mouseover: function (e) {
            var $optionName = $(this).data('option-name');
            Tip($(this).parents(".imageColorBox").find(".color_on_hover").html());
            $("#imageName").text($optionName);
        },

        mouseout: function () {
            UnTip();
        }

    });


    $('.colorbox img').on({
        mouseover: function (e) {
            Tip($(this).parents(".center").find(".hover-image").html());
        },
        mouseout: function () {
            UnTip();
        }
    });

    $('.colorboxs').colorbox({
        overlayClose: true,
        opacity: 0.5,
        rel: "colorboxs"
    });
    $('.colorbox').colorbox({
        overlayClose: true,
        opacity: 0.5,
        rel: "colorbox"
    });

    $(".youtube").each(function () {
        var url = this.id;
        var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/)[1];
        $(this).css('background-image', 'url(https://i.ytimg.com/vi/' + videoid + '/sddefault.jpg)');
        $(this).attr('id', videoid);
        $(this).append($('<div/>', {'class': 'play'}));
        var iframe_url = "https://www.youtube.com/embed/" + videoid;
        $(document).ready(function () {
            $("#" + videoid).trigger('click');
        });
        $(document).delegate('#' + videoid, 'click', function () {
            $(this).colorbox({
                overlayClose: true,
                rel: 'colorboxs',
                iframe: true,
                innerWidth: 700,
                innerHeight: 501,
                href: iframe_url
            });
        });
    });

    $("#toolTip,.toolTipV").click(function () {
        $("#gradeTT").show();
    });


    $("#gradePP").click(function () {
        if (typeof player.stopVideo == 'function') {
            player.pauseVideo();
        }
        $("#gradeTT").hide();
    });

    var $tabs = $('#tabs');
    var id = $('a[href="#swatch"]').parent('li').index();

    $tabs.responsiveTabs({
        rotate: false,
        startCollapsed: false,
        collapsible: 'accordion',
        setHash: false,
        disabled: [id],
        click: function (e, tab) {
            var el = $(tab.selector);
            if (el.data('pop')) {
                var pageURL = $server + 'index.php?route=product/product_grouped/swatch/product_id=' + $product_id;
                var title = 'myPop1';
                var w = 800;
                var h = 800;
                var left = (screen.width / 2) - (w / 2);
                var top = (screen.height / 2) - (h / 2);
                var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
            }
        },

    });

    $('#tabs a').click(function () {
        if ($('#product-iframeV').length) {
            if ($(this).hasClass('tab-youtubelink')) {

            } else {
                if (typeof product_player.stopVideo == 'function') {
                    product_player.pauseVideo();
                }
            }
        }
    });

    $('.descriptions, .discount').hide();
    $('.toggle').css('cursor', 'pointer').click(function () {
        $('.descriptions, .discount, .meno, .piu').toggle()
    });

    $('table.product_grouped tr').mouseover(function () {
        $(this).contents('td').addClass("product_grouped-hover").removeClass("product_grouped-normal");
    }).mouseout(function () {
        $(this).contents('td').removeClass("product_grouped-hover").addClass("product_grouped-normal");
    });

    $('.gp-details').colorbox({
        overlayClose: true,
        opacity: 0.5,
        rel: "gp-details"
    });



// Adding and Removing Dynamic Css Classes  

    $(".grouped_options").children(":first-child").addClass('active');

    $('.option_select').change(function () {
        $(this).parent().removeClass('active').next().addClass('active');
    });
    $(".grouped_options").children(":last-child").change(function () {
        $('.product_grouped').addClass('active');
    });
    $('.qtysum').change(function () {
        $('#form-bundle-addtocart').children('table.active').attr('class', 'product_grouped selected');
        $('.cart').addClass('active');
    });



    $(document).on('change', '.gradeselect', function (event) {
        $.ajax({
            url: 'index.php?route=product/product_grouped/selectcolorgrade&product_id=' + $product_id + '&option_name=' + $('.gradeselect option:selected').attr("name") + '&option_id=' + $('.gradeselect option:selected').val(),
            type: 'post',
            dataType: 'text',
            data: $('.gradeselect option:selected').val(),
            success: function (data)
            {
                $(".selectcolorname").show();
                $(".selectcolor").show();
                $(".selectcolor").empty();
                $(".selectcolor").append(data);
            }
        });

    });

// Code added to give Add to cart same width as price  + quantity column

    $(window).load(function () {
        $('.cart input[type="button"]').width((parseInt($('table.product_grouped td#product_grouped_quantity_column').outerWidth(true))) + (parseInt($('table.product_grouped td#product_grouped_price_column').outerWidth(true))));
    });

//social sharing tags
//    (function (d) {
//        var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
//        p.type = 'text/javascript';
//        p.async = true;
//        p.src = '//assets.pinterest.com/js/pinit.js';
//        f.parentNode.insertBefore(p, f);
//    }(document));

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1532245057038383&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    var script = document.createElement('script');
    script.src = "https://checkout-sandbox.getbread.com/bread.js";
    script.setAttribute('data-api-key', $bread_api_key);
    document.getElementsByTagName("head")[0].appendChild(script);

    function a() {

        var qty_not_avl = 0;
        var total_product_avl = 0;
        var product_avl = [];
        var cur_element;
        $.ajax({
            url: 'index.php?route=product/product_grouped/add&product_id=' + $product_id + '&option_name=' + $('.gradeselect option:selected').attr("name") + '&option_id=' + $('.gradeselect option:selected').val(),
            type: 'post',
            data: $('.product-info select'),
            dataType: 'json',
            success: function (json) {
                $('.success, .warning, .attention, information, .error').remove();
                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            $('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
                        }
                    }
                }
                if (json['success']) {

                    $('.oppriceg').html(json['total']);
                    $('.price-tax').html(json['tax']);
                    //replace json['pricevalue'].length with json['pricevalue']
                    if (json['pricevalue']) {
                        $(json['pricevalue']).each(function (index, element) {
                            cur_element = $('#gp-tbody' + element.gp_id);

                            if (!($('td.callprice', cur_element).length)) {

                                if ($('tbody#gp-tbody' + element.gp_id, 'table.product_grouped').length) {   //becuase json returning some product that are actuallly not there
                                    product_avl.push('gp-tbody' + element.gp_id);
                                    total_product_avl += 1;
                                }

                                if (parseFloat(element.gradeprice) <= 0) {
                                    if ($('.qtysum', cur_element).length && $('.qtysum', cur_element).val())
                                        qty_not_avl += (isNaN(parseInt($('.qtysum', cur_element).val(), 10))) ? 0 : parseInt($('.qtysum', cur_element).val(), 10);

                                    $('.price', cur_element).html('');
                                    if (!($('span.callforprice', cur_element).length))
                                        $('<span class="callforprice"><a href="javascript:void(0);" onclick="PopupCenter1(\'' + element.call_for_price_link + '\', \'myPop1\',400,400)">Call for Price</a></span>').insertBefore($('.price', cur_element));
                                    $('.qtysum', cur_element).val(0).prop('disabled', 'disabled');
                                } else {
                                    $('span.callforprice', cur_element).remove();
                                    $('.qtysum', cur_element).prop('disabled', false);
                                    $('.price', cur_element).html(element.extract_gradeprice);
                                }
                            }
                        });
                        if (total_product_avl < ($('tbody', 'table.product_grouped').length))
                        {
                            $('tbody', 'table.product_grouped').each(function (index, element) {

                                if (($.inArray(element.id, product_avl)) == -1) {
                                    if ($('.price', $('#' + element.id)).length) {
                                        $('span.callforprice', $('#' + element.id)).remove();
                                        $('.price', $('#' + element.id)).html('N/A');
                                        if ($('td.callprice', $('#' + element.id)).length) {
                                            console.log('call for price');
                                        } else {
                                            console.log('na');
                                        }
                                    } else {
                                        $('span.callforprice', $('#' + element.id)).replaceWith($('<div />', {'class': 'price', 'name': 'price'}).html('N/A'));
                                        //($('<div />', {'class': 'price'}).html('N/A')).appendTo($('#'+element.id));
                                    }
                                    $('.qtysum', $('#' + element.id)).val(0).prop('disabled', 'disabled');
                                }
                            });
                        }
                    }

                    if (json['total']) {
                        $('#bundle_price_sum').html(json['total']);
                    }
                    if (typeof json['total_quantity'] != 'undefined') {
                        $('input[name="bundle_quantity_sum"]').val((parseInt(json['total_quantity'], 10)) - qty_not_avl)
                    }    //because quantity can also come 0 so check for if not undefined
                }
                if (json['total_quantity'] != '') {
                    if ($bread_status) {

                        var product = {
                            name: $product_name,
                            price: parseInt($starting_price * 100),
                            sku: 'empty',
                            imageUrl: $thumb,
                            detailUrl: $thumb,
                            quantity: 1,
                        };


                        var items = [product];
                        var opts = {
                            buttonId: 'bread-checkout-btn',
                            items: items,
                            asLowAs: false,
                            actAsLabel: false,
                            customCSS: '@import url(https://fonts.googleapis.com/css?family=Work+Sans:500);*,body,html{ margin:0;padding:0}*{ -webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;-moz-osx-font-smoothing:grayscale}.bread-btn,.bread-btn .bread-pot{ background:0 0}.bread-btn,.bread-label{ text-align:center;font-family:"Work Sans",sans-serif;font-weight:500;text-transform:uppercase;letter-spacing:.13em}*{ outline:0;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none}body,html{ font-family:"Work Sans",sans-serif;font-weight:500}.bread-btn{ background:#fff;box-shadow:none;cursor:pointer;display:inline-block;font-size:10px;line-height:1;border:2px solid #bcbcbc;border-radius:0;color:#666; padding:21px 5px;width:100%;transition:all .4s cubic-bezier(.16,.04,.14,1);box-sizing:border-box}.bread-btn:active,.bread-btn:hover{ border:2px solid #3d86bf;color:#3d86bf}.bread-btn.bread-as-low-as .bread-as-low-as:before,.bread-label .bread-as-low-as:before{ content:"As low as "}.bread-btn .bread-embed-icon{ display:none}.bread-btn .bread-pot:after{ content:"Pay over time";position:relative}.bread-label{ color:#666;display:block}.bread-label:hover{ color:#00a79d}.bread-label .bread-embed-icon{ display:none}',
                            done: function (err) {
                                if (err !== null) {
                                    alert("There was an error!" + err);
                                    return;
                                }
                            }
                        };
                        bread.checkout(opts);
                    }
                }
            }
        });
    }


//no need to check for price in case of call for price on for grouped product   
    if (!$call_for_price) {
        $(document).on("change", ".option .gradeselect", a);
        $(document).on("change", ".qtysum", a);
    }

});








