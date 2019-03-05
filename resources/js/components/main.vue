<template>
	<v-app id="main">
 			<v-content>
 				<v-toolbar app  dark class="red darken-2">
					<v-btn class="white--text" @click="$router.push({name:'لوجة التحكم'})" icon><v-icon>home</v-icon></v-btn>
				    <v-toolbar-title>{{$router.currentRoute.name}}</v-toolbar-title>
				    <v-spacer></v-spacer>
				    <v-toolbar-items>
				         
				    </v-toolbar-items>
				</v-toolbar>
 				
 					<v-container fluid grid-list-md>
						<router-view></router-view>
 					</v-container>
			</v-content>
	</v-app>
</template>
<script>
	export default {
		data() {
			return {
		        
			}
		}
	}
</script>
<style>
	
</style>