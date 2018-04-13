<?php echo '
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>

    <script>
        var x, y;
        $(".add_basket").click(function() {
            var id = $(this).attr("name");
            var elem = $(this).parents(".item");
            $.ajax({
                type: "POST",
                url: "includes/basket.php",
                data: { 
                    basket_action: "add",
                    product_id: id, 
                    amount: 1 
            }}).success(function(data) {
                var xi = elem.offset().left;
                var yi = elem.offset().top;
                elem.css("left", xi).css("top", yi);
                x = $("#basket-overview").offset().left;
                y = $("#basket-overview").offset().top;
                var elem_cloned = elem.clone();
                elem.parents(".container").prepend(elem_cloned);
                elem_cloned.css({
                    "left": xi,
                    "top": yi,
                    "position": "absolute",
                    "opacity": 0.4
                });
                elem_cloned.animate({
                    left: x,
                    top: y},{
                    "complete" : function() {
                        elem_cloned.remove();
                    }
                });
                $("#basket-overview a span").text(data + " items in cart");
            });
        });
        $(".remove_basket").click(function() {
            var id = $(this).attr("name");
            $.ajax({
                type: "POST",
                url: "includes/basket.php",
                data: {
                    basket_action: "remove", 
                    product_id: id, 
                    amount: 1 
            }}).done(function() {
                location.reload();
            });
        });
    </script>
'; ?>
