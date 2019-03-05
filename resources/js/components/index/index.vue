<template>
	<v-layout align-center justify-center row wrap>
		<v-flex xs4 md4 lg4 @click="$router.push({name:'الاقسام'})">
			<v-card style="cursor: pointer;">
				<v-card-title class="pink darken-1 white--text">
					<div class="title text-xs-center font-weight-black" style="width: 100%;">
						ألاقسام
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs4 md4 lg4 @click="$router.push({name:'اصناف'})">
			<v-card style="cursor: pointer;">
				<v-card-title class="pink darken-2 white--text">
					<div class="title text-xs-center font-weight-black" style="width: 100%;">
						الاصناف
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs4 md4 lg4 @click="$router.push({name:'نجوم'})">
			<v-card style="cursor: pointer;">
				<v-card-title class="yellow darken-1 white--text">
					<div class="title text-xs-center font-weight-black" style="width: 100%;">
						نجوم
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs4 md4 lg4 @click="$router.push({name:'محلات'})">
			<v-card style="cursor: pointer;">
				<v-card-title class="yellow darken-1 white--text">
					<div class="title text-xs-center font-weight-black" style="width: 100%;">
						محلات
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs4 md4 lg4 @click="$router.push({name:'الدول'})">
			<v-card style="cursor: pointer;">
				<v-card-title class="yellow darken-1 white--text">
					<div class="title text-xs-center font-weight-black" style="width: 100%;">
						الدول
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs4 md4 lg4 @click="$router.push({name:'المدن'})">
			<v-card style="cursor: pointer;">
				<v-card-title class="yellow darken-1 white--text">
					<div class="title text-xs-center font-weight-black" style="width: 100%;">
						المدن
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs4 md4 lg4 @click="$router.push({name:'طلبات التوثيق'})">
			<v-card style="cursor: pointer;">
				<v-card-title class="yellow darken-1 white--text">
					<div class="title text-xs-center font-weight-black" style="width: 100%;">
						طلبات التوثيق
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
	</v-layout>
</template>
<script>
	export default {
		
	}
</script>