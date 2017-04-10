<?php // header, form searching ?>



<style>

	.text-header-slider{

		background-color:#06F;

		opacity:0.8;

		z-index:100;	

	} 
	
	/* .bootstrap-select{
		
		margin-top:-10px;
		display:block !important;
		color:#000 !important;
	
	}
	
	.selectpicker
	{
		color:#000 !important;	
	}
	
	.btn{
		color:#000 !important;
		margin:10px 0 !important;	
	} */
	
	.job-form{
		padding:24px 40px !important;	
	}

</style>



<header style="height:">

	<form class="col-md-3 col-md-offset-3 col-sm-6 col-xs-12 job-form round" id="frm-search-dashboard" role="form">

		<h4><?=$this->lang->line("search")?> <?=$this->lang->line("vacantsea")?>, <?=$this->lang->line("agentsea")?>, <?=$this->lang->line("or")?> 
		<?=$this->lang->line("seatizen")?> <i class="fa fa-arrow-right small-icon"></i></h4>

		<input type="text" id="keywordnya" class="form-control white search-query" placeholder="Please enter a keyword ...">

       <!--  <input type="text" class="form-control white" id="form-vesel" placeholder="select vessel type ..."> -->
       <select class="form-control white" id="form-vesel">
          <option value=""><?=$this->lang->line("vessel_type")?></option>
          
      </select>
        
		<!-- <input type="text" class="form-control white" id="form-department" placeholder="select department ... "> -->
        <select class="form-control white" id="form-department">
            <option value="">Department</option>
            
        </select>

        <!-- <input type="text" class="form-control white" id="form-nationality" placeholder="select nationalities ... "> -->
        <select class="form-control white" id="form-nationality">
            <option value="">Nationality</option>
            
        </select>
        
        <div class="col-md-6">
        <select class="form-control white" style="" id="form-vacantsea">

            <option value="vacantsea"><?=$this->lang->line("vacantsea")?></option>

            <option value="seatizen"><?=$this->lang->line("seatizen")?></option>

        </select>
        </div>
        
        <div>
        <button type="submit" class="btn orange">

			<?=$this->lang->line("search")?> <i class="fa fa-chevron-right"></i>

		</button>
        </div>
        

		<!-- <div class="col-md-6 no-padding">

			<a href="#" class="dropdown-input white">Type</a>

			<ul class="dropdown">

				<li><a href="#">Monday</a></li>

				<li><a href="#">Tuesday</a></li>

				<li><a href="#">Wendsday</a></li>

				<li><a href="#">Thursday</a></li>

				<li><a href="#">Friday</a></li>

				<li><a href="#">Saturday</a></li>

				<li><a href="#">Sunday</a></li>

			</ul>

		</div> -->

		

	</form>

	<div class="owl-carousel owl-header">
		
        <div class="item" data-background="<?=asset_url("img/img-bg-landing-page.jpg")?>"></div>
        <div class="item" data-background="<?=asset_url("landingpage2/img/header/header.jpg")?>"></div>
		
            <!-- 

            cara resmi menaruh tulisan di header sidebar

            <div class="pull-left col-md-6">

            	

            </div>

            <div class="pull-left col-md-4 text-header-slider" >

            	<h2> Lorem ipsum </h2>

                

               <p>

               	On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document. You can use these galleries to insert tables, headers, footers, lists, cover pages, and other document building blocks. When you create pictures, charts, or diagrams, they also coordinate with your current document look. You can easily change the formatting of selected text in the document text by choosing a look for the selected text from the Quick Styles gallery on the Home tab. You can also format text directly by using the other controls on the Home tab.

               </p>

               

               <p>

               	Most controls offer a choice of using the look from the current theme or using a format that you specify directly. To change the overall look of your document, choose new Theme elements on the Page Layout tab. To change the looks available in the Quick Style gallery, use the Change Current Quick Style Set command. Both the Themes gallery and the Quick Styles gallery provide reset commands so that you can always restore the look of your document to the original contained in your current template. On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document.

               </p>

            

            </div> -->

        <div class="item" data-background="<?=asset_url("landingpage2/img/header/header2.jpg")?>"></div>

        <div class="item" data-background="<?=asset_url("landingpage2/img/header/header3.jpg")?>"></div>

	</div>

</header>