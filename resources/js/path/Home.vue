<template>
    <div class="container">
         <section class="home-slider owl-carousel">
		<div class="slider-item">
            <img src="/storage/bg/bg_1.jpg" alt="">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center"
					data-scrollax-parent="true">
					<div class="col-md-8 text-center ftco-animate">
						<h1 class="mb-4">Kids Are The Best<span>Explorers In The World</span></h1>
						<p><a href="#" class="btn btn-secondary px-4 py-3 mt-3">Read More</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
    </div>
</template>
<style scoped>  
 .slider-item{
    position: relative;
 }
 .slider-item>img{
      position: absolute;
      z-index: -1;
      width: 100%;
 }
 .ftco-animate{
    display: flex;
    justify-content: center;
    flex-direction: column;
     padding-top:10rem;
   
 }
 
</style>
<script>


export default {
    beforeCreate() {
        this.$store.dispatch('verify');
   },
}
</script>
