
		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-mini">

			<div class="container clearfix">
				<h1>ข้อมูลพื้นฐาน</h1>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="">

					<!-- Posts
					============================================= -->

						<table class="table table-striped table-bordered dataTable" id="table" style="width: 100%">
							<thead>
								<tr>
									<th>ลำดับ</th>
									<th style="text-align: center;">รายการ</th>
									<th>วันที่อัพเดท</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

					
					

				</div>

			</div>

		</section><!-- #content end -->
	<script>

		$(document).ready(function() {
			$('#table').dataTable({
		        "ajax": "<?=base_url();?>information/information_list/<?=$this->uri->segment(5)?>",
		        "iDisplayLength" : 50,
		        "scrollX": true,
		        "columns": [          
		            { render: function (data, type, row, meta) {
		                return meta.row + meta.settings._iDisplayStart + 1;
		            },sWidth: '30px',"className": "text-center"},
		            { "data":function(data){
						return '<a href="<?=base_url()?>information/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
		            } },
		            { "data":function(data){
		              if(data.update_datetime!=null){
		                return data.update_datetime;
		              }else{
		                return data.create_datetime;
		              }      
		            },sWidth: '120px'  },
		        ],
		     });
		});

	function remove_spc(string){
        if(string===''){
          return 'null';
        }
        return string.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/[_\s]/g, '-')
     }
	</script>


	