<style>
    #scrollToTopBtn {
    display: none; 
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 99;
    border: none;
    outline: none;
    background:linear-gradient(to right, #da00ff, #008fff);
    color: white;
    cursor: pointer;
    font-size: 20px;
    padding: 10px;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    &:hover{
        background:linear-gradient(to right,#008fff , #da00ff);;
    }
}

</style>
<button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">↑</button>
<script>
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    }

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' 
        });
    }
</script>
