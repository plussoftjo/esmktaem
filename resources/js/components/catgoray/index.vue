<template>
	<v-layout row wrap>
		<v-flex xs6 v-if="DoNow">
			<v-card class="pink darken-1 white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="title" style="width: 100%;">
						اضافة قسم جديد
					</div>
				</v-card-title>
			</v-card>
			<v-card class="pink white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="title" style="width: 100%;">
						<v-text-field
						label="عنوان القسم"
						v-model="catg.title"
						solo></v-text-field>
					</div>
					<div>
						<v-select
						:items="sections"
						solo
						label="الثسم"
						v-model="catg.section"></v-select>
					</div>

					<v-btn class="blue" @click.native="openImage" dark><v-icon>attachment</v-icon>رفع صورة</v-btn>
						<div class="inputF">
							<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
						</div>
					<div style="width: 100%;">
						<v-btn class="success" block @click="store">حفظ</v-btn>
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs6 v-else>
			<v-card class="pink darken-1 white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="title" style="width: 100%;">
						اضافة قسم جديد
					</div>
				</v-card-title>
			</v-card>
			<v-card class="pink white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="title" style="width: 100%;">
						<v-text-field
						label="عنوان القسم"
						v-model="catg.title"
						solo></v-text-field>
					</div>
					<div style="width: 100%;">
						<v-select
						:items="sections"
						solo
						label="القسم"
						v-model="catg.section.title"></v-select>
					</div>
					<div style="width: 100%;">
					<v-btn class="blue" @click.native="openImage" dark><v-icon>attachment</v-icon>تغير الصورة</v-btn>
						<div class="inputF">
							<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
						</div>	
					</div>
					<div style="width: 100%;">
						<v-btn class="success" block @click="update">تحديث</v-btn>
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs6>
			<v-card class="pink darken-1 white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="title" style="width: 100%;">
						الاصناف
					</div>
				</v-card-title>
			</v-card>
			<v-card class="pink darken-1 white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="text-xs-center " style="width: 100%;">
						<v-card class="grey lighten-1 white--text">
							<v-card-title class="font-weight-black title"> 
								<v-layout >
									<v-flex xs4 class="pt-3" style="border-left:1px solid black;">
										العنوان
									</v-flex>
									<v-flex xs4 class="pt-3" style="border-left:1px solid black;">
										القسم
									</v-flex>
									<v-flex xs4 class="pt-3">
										تعديل
									</v-flex>
								</v-layout>
							</v-card-title>
						</v-card>
					</div>
					<v-divider></v-divider>
					<div class="text-xs-center mb-3" style="width: 100%;" v-for="i in catgs">
						<v-card>
							<v-card-title class="font-weight-black "> 
								<v-layout >
									<v-flex xs4 class="pt-3" style="border-left:1px solid black;">
										{{i.title}}
									</v-flex>
									<v-flex xs4 class="pt-3" style="border-left:1px solid black;">
										{{i.section.title}}
									</v-flex>
									<v-flex xs4>
										<v-btn icon class="blue--text" small @click="() => {catg = i; DoNow = false;}"><v-icon>build</v-icon></v-btn>
									</v-flex>
								</v-layout>
							</v-card-title>
						</v-card>
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
	</v-layout>
</template>
<script>
	export default {
		data() {
			return {
				catg:{},
				sections:[],
				catgs:[],
				DoNow:true
			}
		},
		methods:{
			installSection() {
				const vm = this;
				axios.get('admin/section/index').then(response => {
					response.data.forEach(trg => {
						vm.sections.push(trg.title);
					});
				}).catch(err => {
					console.log(err);
				});
			},
			install() {
				const vm = this;
				axios.get('admin/catg/index').then(response => {
					vm.catgs = response.data;
				}).catch(err => {
					console.log(err);
				});
			},
			store() {
				const vm = this
				axios.post('admin/catg/store',vm.catg).then(response => {
					console.log(response.data)
				}).catch(err => {
					console.log(err)
				});
			},
			update() {
				const vm = this;
				axios.post('admin/catg/update',vm.catg).then(response => {
					vm.DoNow = true;
					vm.catg= {title:'',section:''}
				}).catch(err => {
					console.log(err);
				});
			},
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
	              vm.catg.image = e.target.result;
	          };
	          reader.readAsDataURL(file);
	       },
		},
		created() {
			const vm = this;
			vm.installSection();
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
