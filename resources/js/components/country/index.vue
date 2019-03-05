<template>
	<div class="country">
		<v-layout row align-center>
			<v-flex xs4>
				<v-card class="pink darken-2 white--text">
					<v-card-title>
						اضافة دولة
					</v-card-title>
				</v-card>
				<v-card>
					<v-card-title>
						<div style="width: 100%;">
							<v-text-field
							label="اسم الدولة"
							solo
							v-model="country.name"></v-text-field>							
						</div>
						<v-btn class="blue" @click.native="openImage" dark><v-icon>attachment</v-icon>تغير الصورة</v-btn>
						<div class="inputF">
							<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
						</div>		
						<div style="width: 100%;">
							<v-btn class="success" dark block @click="store">حفظ</v-btn>
						</div>					
					</v-card-title>
				</v-card>
			</v-flex>
			<v-flex xs8>
				<v-card>
					<v-card-title class="pink darken-2 white--text">
						الدول
					</v-card-title>
				</v-card>
				<v-card>
					<v-card-title>
						<v-layout row wrap>
							<v-flex xs6 v-for="c in countrys" :key="c.id">
								<v-card>
									<v-img
									height="200px"
									:src="c.flag"
									contain></v-img>
									<v-card-title class="title font-weight-black">
										{{c.name}}
									</v-card-title>
								</v-card>
							</v-flex>
						</v-layout>
					</v-card-title>
				</v-card>
			</v-flex>
		</v-layout>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				country:{},
				countrys:[]
			}
		},
		methods:{
			openImage() {
				const vm = this;
				vm.$refs.image.click();
			},
			onFileChange(e) {
	        let files = e.target.files || e.dataTransfer.files;
	         if (!files.length)
	            return;
	        this.createImage(files[0]);
	        },
	        createImage(file) {
	         let reader = new FileReader();
	          let vm = this;
	          reader.onload = (e) => {
	              vm.country.image = e.target.result;
	          };
	          reader.readAsDataURL(file);
	       },
	       store() {
	       	const vm = this;
	       	axios.post('/admin/country/store',vm.country).then(response => {
	       		vm.countrys.push(response.data)
	       	}).catch(err => {
	       		console.log(err)
	       	});
	       },
	       install() {
	       	const vm = this;
	       	axios.get('/admin/country/index').then(response => {
	       		vm.countrys = response.data;
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
<style scoped>
    .inputF {
        position: absolute;
        left: -99999px;
    }
</style>
