<template>
	<div class="star">
		<v-layout row align-center justify-center>

					<v-img
					:src="star.image"
					contain
					height="200px"
					width="200px"></v-img>
		</v-layout>
		<v-layout row align-center justify-center>
				<div class="title mt-2 font-weight-black" >
					{{star.name}}
				</div>
				
		</v-layout>
		<v-layout row align-center justify-center>
			<div>
					<v-btn class="primary">تعديل</v-btn>
					<v-btn class="red" dark>حذف</v-btn>
				</div>
		</v-layout>
		<v-card>
			
		</v-card>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				star:{}
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('admin/star/show/' + vm.$route.params.id).then(response => {
					vm.star = response.data;
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>