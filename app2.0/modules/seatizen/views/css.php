<style>
/*paging*/
.pagination {
	height: 36px;
	margin: 18px 0;
}.pagination ul {
	display: inline-block;
}.pagination li {
	display: inline;
	margin-left: 2px;
	margin-right: 2px;
}.pagination a {
	padding: 6px 12px;
}.pagination a:hover,.pagination .active a {
	background-color: #ECF6FF;
	border: 1px solid;
	border-color: #2e6da4;
}

#notfound{
	text-align: center;
	background-color: #ECF6FF;
	font-size: 30px;
	font-style: bold;
	border-radius: 5px;
}.available{
	color: black;
	font-style: bold;
	background-color: red;
	border-radius: 15px;
	padding: 4px 8px 4px 8px;
	margin-bottom: 50px;
	text-align: right;
}

/*pop up gambar*/
.modal-backdrop
{
	z-index:-1 !important;	
}
/*sub-header*/
.sub-header-left{
	float: left;
}
.sub-header-right{
	float: right;
}
/*expired date*/
.title-expired{
	color: red;
	cursor: pointer;
}
</style>

<style>
	.box {
	  /* width: 300px; height: 200px; */
	  /* position: relative;
	  /* border: 1px solid #BBB;*/
	  /* background: #EEE;*/
	  /* float:left;*/ 
	  margin-right:50px;
	}
	.ribbon {
	  position: absolute;
	  right: -16px; top: -12px;
	  z-index: 1;
	  overflow: hidden;
	  width: 95px; height: 100px;
	  text-align: right;
	}
	.ribbon span {
	  font-size: 14px;
	  font-weight: bold;
	  color: #FFF;
	  text-transform: uppercase;
	  text-align: center;
	  line-height: 30px;
	  transform: rotate(45deg);
	  -webkit-transform: rotate(45deg);
	  width: 105px;
	  display: block;
	  background: #33CCFF;
	  background: linear-gradient(#33CCFF 0%, #33CCFF 100%);
	  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
	  position: absolute;
	  top: 30px; right: -6px; left: -6px; 
	}
	.ribbon span::before {
	  content: "";
	  position: absolute; left: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid #79A70A;
	  border-right: 3px solid transparent;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #79A70A;
	}
	.ribbon span::after {
	  content: "";
	  position: absolute; right: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid transparent;
	  border-right: 3px solid #79A70A;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #79A70A;
	}

</style>