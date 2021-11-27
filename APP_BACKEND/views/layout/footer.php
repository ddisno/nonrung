<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> CI 0
    </div>
    <strong>Copyright &copy; 2019 <a href="https://nonrung.go.th">nonrung.go.th</a>.</strong> All rights By <a href="https://meeting.co.th">Meeting Creative </a>
  </footer>

</div>
<!-- ./wrapper -->

</body>
<script type="text/javascript">
		
		function active(){
			for (var i=0 ; i <= 7; i++) {
				var parent = $("li .active").parents().eq(i);
				if(parent.hasClass('sidebar-menu')){
					return;
				}

				if(parent.is('li')){
					var menu_li = parent.addClass('menu-open');
					var menu_ul = menu_li.parent();
					if(menu_ul.hasClass('sidebar-menu')){
						menu_li.addClass('active');
					}

				}else{
					parent.css('display', 'block');
					
				}
			}
		}
		active();
</script>
</html>
