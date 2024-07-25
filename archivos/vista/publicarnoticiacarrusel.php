
    


</div>
<script>
    $(document).ready(function(){
        $.ajax({
            url: 'getImages.php',
            method: 'GET',
            success: function(data) {
                $('.carousel-inner').html(data);
            }
        });
    });
</script>
        