jQuery(function ($) {

    'use strict';

    // -------------------------------------------------------------
    //  Placeholder
    // -------------------------------------------------------------

    (function () {

        var textAreas = document.getElementsByTagName('textarea');

        Array.prototype.forEach.call(textAreas, function (elem) {
            elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
        });

    }());


    // -------------------------------------------------------------
    //  Show 
    // -------------------------------------------------------------

    (function () {

        $("document").ready(function ()
        {
            $(".more-category.one").hide();
            $(".show-more.one").click(function ()
            {
                $(".more-category.one").show();
                $(".show-more.one").hide();
            });
        });

        $("document").ready(function ()
        {
            $(".more-category.two").hide();
            $(".show-more.two").click(function ()
            {
                $(".more-category.two").show();
                $(".show-more.two").hide();
            });
        });

        $("document").ready(function ()
        {
            $(".more-category.three").hide();
            $(".show-more.three").click(function ()
            {
                $(".more-category.three").show();
                $(".show-more.three").hide();
            });
        });

    }());


    // -------------------------------------------------------------
    //  Slider
    // -------------------------------------------------------------

    (function () {

        $('#price').slider();

    }());


    // -------------------------------------------------------------
    //  language Select
    // -------------------------------------------------------------

    (function () {

        $('.category-dropdown').on('click', '.category-change a', function (ev) {
            if ("#" === $(this).attr('href')) {
                var data = $(this).attr('data');
                ev.preventDefault();
                var parent = $(this).parents('.category-dropdown');
                parent.find('.change-text').html($(this).html());
                $("#search-location").val(data);
            }
        });

    }());


    // -------------------------------------------------------------
    // Accordion
    // -------------------------------------------------------------

    (function () {
        $('.collapse').on('show.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
        });

        $('.collapse').on('hide.bs.collapse', function () {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
        });
    }());


    // -------------------------------------------------------------
    //  Checkbox Icon Change
    // -------------------------------------------------------------

    (function () {

        $('input[type="checkbox"]').change(function () {
            if ($(this).is(':checked')) {
                $(this).parent("label").addClass("checked");
            } else {
                $(this).parent("label").removeClass("checked");
            }
        });

    }());


    // -------------------------------------------------------------
    //  select-category Change
    // -------------------------------------------------------------
    $('.select-category.post-option ul li a').on('click', function () {
        $('.select-category.post-option ul li.link-active').removeClass('link-active');
        $(this).closest('li').addClass('link-active');
    });

    $('.subcategory.post-option ul li a').on('click', function () {
        $('.subcategory.post-option ul li.link-active').removeClass('link-active');
        $(this).closest('li').addClass('link-active');
    });


    $(".job-dropdown button").on('click', function () {
        $(".dropdown-menu").slideToggle('fast');
    });

    $(".dropdown dd ul li a").on('click', function () {
        $(".dropdown dd ul").hide();
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown"))
            $(".dropdown dd ul").hide();
    });

    $('.dropdown-menu input[type="checkbox"]').on('click', function () {

        var title = $(this).closest('.dropdown-menu').find('input[type="checkbox"]').val(),
                title = $(this).val() + ",";

        if ($(this).is(':checked')) {
            var html = '<span title="' + title + '">' + title + '</span>';
            $('.multiSel').append(html);
            $(".hida").hide();
        } else {
            $('span[title="' + title + '"]').remove();
            var ret = $(".hida");
            $('.dropdown dt a').append(ret);

        }
    });

// script end
});
