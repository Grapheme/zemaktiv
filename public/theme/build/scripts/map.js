$.fn.smart_map = function (map_array) {
    $(this).each(function () {
        var parent = $(this),
            map_block = parent.find('.js-map-block'),
            map_desc = parent.find('.js-map-desc'),
            active_id = false;

        if (parent.hasClass('js-admin-map')) {
            $(document).on('click', '.js-map-dot', function () {
                return false;
            });

            $(document).on('click', '.js-map-block', function (e) {
                admin_click(e);
            });

            $(document).on('input', '.js-admin-map-x, .js-admin-map-y', function () {
                admin_pos();
            });

            $(document).on('change', '.js-admin-map-radius', function () {
                admin_rad();
            });

        } else {
            $(document).on('click', '.js-map-dot', function () {
                var id = $(this).attr('data-id');
                openDesc(id);

                return false;
            });

            $(document).on('click', '.js-desc-close', function () {
                closeDesc();
                return false;
            });

            $(document).on('click', '.js-map-control', function () {
                goDesc($(this).attr('data-direction'));
                return false;
            });
        }

        function admin_click(e) {
            var x = e.pageX - map_block.offset().left;
            var y = e.pageY - map_block.offset().top;
            if (parent.find('.js-admin-dot').length) {
                parent.find('.js-admin-dot').css({
                    'left': x,
                    'top': y
                });
            } else {
                var dot_default = {
                    radius: $('.js-admin-map-radius').val(),
                    posY: y,
                    posX: x
                };

                var str = dotStr(0, dot_default, true);
                parent.find('.js-map-block').append(str);
            }

            $('.js-admin-map-x').val(Math.round(x));
            $('.js-admin-map-y').val(Math.round(y));
        }

        function admin_pos() {
            var x = parseInt($('.js-admin-map-x').val());
            var y = parseInt($('.js-admin-map-y').val());

            parent.find('.js-admin-dot').css({
                'left': x,
                'top': y
            });
        }

        function admin_rad() {
            var x = parseInt($('.js-admin-map-x').val());
            var y = parseInt($('.js-admin-map-y').val());
            var radius = parseInt($('.js-admin-map-radius').val());

            parent.find('.js-admin-dot').remove();
            var dot_settings = {
                radius: parseInt($('.js-admin-map-radius').val()),
                posY: y,
                posX: x
            };

            var str = dotStr(0, dot_settings, true);
            parent.find('.js-map-block').append(str);
        }

        function goDesc(d) {
            var dir;
            if (d == '<') {
                dir = -1;
            } else {
                dir = 1;
            }

            var new_id = active_id + dir;

            if (new_id == -1) {
                new_id = map_array.length - 1;
            }
            if (new_id == map_array.length) {
                new_id = 0;
            }

            openDesc(new_id);
        }

        function openDesc(id) {
            var id_array = map_array[id];
            var items = id_array.items;
            var city = id_array.name;
            var posX = id_array.posX;
            var posY = id_array.posY;

            var items_str = '';
            $.each(items, function (index, value) {
                items_str += '<li>' + value;
            });
            map_desc.find('.js-desc-title').text(city);
            map_desc.find('.js-desc-items').html(items_str);
            setTimeout(function () {
                map_desc.find('.js-desc-items').customScrollbar();
            }, 1);

            var map_block_x = map_block.width() / 4 - posX;
            var map_block_y = map_block.height() / 2 - posY;
            var transform_str = transform('translateX(' + map_block_x + 'px) translateY(' + map_block_y + 'px)');

            map_block.attr('style', transform_str);

            $('.js-map-dot[data-id=' + id + ']').addClass('active')
                .siblings().removeClass('active');

            map_desc.show();
            active_id = parseInt(id);
        }

        function closeDesc() {
            map_block.attr('style', transform('translateX(0px) translateY(0px)'));
            $('.js-map-dot').removeClass('active');
            map_desc.hide();
        }

        function dotStr(index, value, admin_dot) {
            var rad_width = value.radius * 1;
            var style_str = 'margin-top: -' + rad_width / 2 + 'px; ' +
                'margin-left: -' + rad_width / 2 + 'px; ' +
                'width: ' + rad_width + 'px; ' +
                'height: ' + rad_width + 'px; ' +
                'border-radius: ' + rad_width + 'px; ';
            if (admin_dot) {
                var admin_class = ' js-admin-dot';
            } else {
                var admin_class = '';
            }

            var str = '<a href="#" class="map-dot js-map-dot' + admin_class + '" style="top: ' + value.posY + 'px; left: ' + value.posX + 'px;" data-id="' + index + '">' +
                '<i class="map-rad" style="' + style_str + '"></i>' +
                '</a>';

            return str;
        }

        function init(x, y, r) {
            var map_html = '';

            //if (typeof map_array != 'undefined' && map_array.length)
            //    mar_array = [{posX: x, posY: y, radius: r}]

            $.each(map_array, function (index, value) {
                var str = dotStr(index, value, true);
                map_html += str;
            });

            map_block.html(map_html);
            map_desc.hide();

            if ($(window).width() <= 768) {
                openDesc(0);
            }
        }

        init();
    });
}