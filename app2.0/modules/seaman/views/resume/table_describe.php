<?php ?>

<div class="">

	<div class="pull-left col-md-4">

      <h3> Profile </h3>

      <i> ( Describe yourselves )</i>

    </div>

    <button class="pull-right btn btn-filled btn-sm" id="describe-btn" modal="form-edit-describe">

        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;<?=$this->lang->line("edit")?>

    </button>

    <div class="clearfix"></div>

    <hr />

   	<?php if(!empty($profile["describe"])){

		echo paragraph($profile["describe"]);

		echo "<i class='fa fa-quote-left' aria-hidden='true'></i> &nbsp; ";

		//echo "<i style='font-size:16px'>".paragraph($profile["describe"])."</i>";

		echo " &nbsp; <i class='fa fa-quote-right' aria-hidden='true'></i>  ";

		

	}else

	{

		echo "<i> Please Describe yourselves </i>";	

	}?>    

    <hr />

    

	

</div>