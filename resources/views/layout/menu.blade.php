<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
        	Menu
        </li>
        @foreach($theloai as $tl)
        	@if(count($tl->loaitin) >0)
	            <li href="page/" class="list-group-item menu1">
	            	{{$tl->Ten}}
	            </li>
	            <ul>
	            	@foreach($tl->loaitin as $loaitin)
	        		<li class="list-group-item">
	        			<a href="loaitin/{{$loaitin->id}}/{{$loaitin->TenKhongDau}}.html">{{$loaitin->Ten}}</a>
	        		</li>
	        		@endforeach 	                		
	            </ul>  
            @endif  
        @endforeach                
    </ul>
</div>