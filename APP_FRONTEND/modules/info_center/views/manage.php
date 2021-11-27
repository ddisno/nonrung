
		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-mini">

			<div class="container clearfix">
				<h1>ศูนย์ข้อมูลข่าวสารทั้งหมด</h1>
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
									<th style="min-width: 60px;">ลำดับ</th>
									<th style="min-width: 150px;">เรื่อง</th>
									<th style="min-width: 80px;"> วันที่อัพเดท</th>
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
		        "ajax": "<?=base_url();?>info_center/info_center_list/<?=$this->uri->segment(5)?>",
		        "iDisplayLength" : 50,
		        "scrollX": true,
		        "columns": [          
		            { render: function (data, type, row, meta) {
		                return meta.row + meta.settings._iDisplayStart + 1;
		            }},
		            { "data":function(data){
						return '<a href="<?=base_url()?>info_center/view/'+remove_spc(data.name_th)+'/'+data.id_info_center+'">'+data.name_th+'</a>';
		            } },
		            { "data":function(data){
		              if(data.update_datetime!=null){
		                return data.update_datetime;
		              }else{
		                return data.create_datetime;
		              }      
		            } },
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


	