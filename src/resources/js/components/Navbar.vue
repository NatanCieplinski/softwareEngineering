<template>
	<nav class="navbar navbar-expand-lg" id="navbar">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="#">
			<img src="/img/logo.png" id="logo">
		</a>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<router-link class="nav-link" to="/">Prenota</router-link>
				</li>
				<li class="nav-item">
					<router-link class="nav-link" to="/prenotazioni">Prenotazioni</router-link>
				</li>
				<li class="nav-item">
					<router-link class="nav-link" to="/login">Login</router-link>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
			</form>
		</div>
	</nav>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
	#navbar{
		background-color: #822626;
	}

	#logo{
		height:10%;
		width:10%;
	}
	.nav-link{
		color: white;
	}
</style>