<template>
	<v-layout row wrap>
		<v-flex xs6 v-if="DoNew">
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
						v-model="section.title"
						solo></v-text-field>
					</div>
					<div>
						<v-btn class="blue" @click.native="openImage" dark><v-icon>attachment</v-icon> اضافة صورة</v-btn>
						<div class="inputF">
							<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
						</div>
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
						تعديل القسم
					</div>
				</v-card-title>
			</v-card>
			<v-card class="pink white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="title" style="width: 100%;">
						<v-text-field
						label="عنوان القسم"
						v-model="selected.title"
						solo></v-text-field>
					</div>
					<div>
						<v-btn class="blue" @click.native="openUpdateImage" dark><v-icon>attachment</v-icon>تغير الصورة</v-btn>
						<div class="inputF">
							<input type="file" v-on:change="onFileChangeUpdate" class="form-control" ref="imageUpdate">
						</div>
					</div>
				</v-card-title>
				<v-card-title>
					<div style="width: 100%;">
						<v-btn class="success" @click="update">تحديث</v-btn>
						<v-btn >الغاء</v-btn>
					</div>
				</v-card-title>
			</v-card>
		</v-flex>
		<v-flex xs6>
			<v-card class="pink darken-1 white--text text-xs-center">
				<v-card-title style="width: 100%;">
					<div class="title" style="width:100%;">
						الأقسام
					</div>
				</v-card-title>
			</v-card>
			<v-card class="pink white--text text-xs-center">
				<v-card-title>
					<div style="width: 100%;" class="mt-3" v-for="(section,index) in sections" :key="index" 
					>
						<v-card >
							<v-img
							:src="section.image"
							conatin></v-img>
							<v-card-title class="grey lighten-1 white--text">
								<div class="title font-weight-black">
									{{section.title}}
								</div>
								<v-spacer></v-spacer>
								<v-btn class="blue" fab dark @click="() => {DoNew = false; selected = section; selected.index = index;}"><v-icon>build</v-icon></v-btn>
								<v-btn class="red" fab dark @click="destroy(section.id,index)"><v-icon>delete</v-icon></v-btn>
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
				section:{title:''},
				sections:[],
				errors:[],
				DoNew:true,
				selected:{},
				image:''
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
	              vm.section.image = e.target.result;
	          };
	          reader.readAsDataURL(file);
	       },
	       store() {
	       	const vm = this;
	       	axios.post('/admin/section/store',vm.section).then(response => {
	       		vm.sections.push(response.data);
	       	}).catch(err => {
	       		vm.errors = err.response.data.errors;
	       	});
	       },
	       fetch() {
	       	const vm = this;
	       	axios.get('/admin/section/index').then(response => {
	       		vm.sections = response.data;
	       	}).catch(err => {
	       		vm.errors.push({'network': 'network Errors'});
	       	});
	       },
	       openUpdateImage() {
	       	const vm = this;
	       	vm.$refs.imageUpdate.click();
	       },
	       onFileChangeUpdate(e) {
	        let files = e.target.files || e.dataTransfer.files;
	         if (!files.length)
	            return;
	        this.createImageUpdate(files[0]);
	        },
	        createImageUpdate(file) {
	         let reader = new FileReader();
	          let vm = this;
	          reader.onload = (e) => {
	              vm.image = e.target.result;
	              vm.StoreNewImage();
	          };
	          reader.readAsDataURL(file);
	       },
	       StoreNewImage()
	       {
	       	const vm = this;
	       	axios.post('/admin/section/updateImage/' + vm.selected.id,{image:vm.image}).then(response => {
	       		vm.sections[vm.selected.index].image = response.data.image;
	       	}).catch(err => {

	       	});
	       },
	       update() {
	       	const vm = this;
	       	axios.post('/admin/section/update/' + vm.selected.id,{title:vm.selected.title}).then(response => {
	       		vm.DoNew = true;
	       		vm.section[vm.selected.index].title = vm.selected.title;
	       	}).catch(err => {
	       		console.log(err)
	       	});
	       },
	       destroy(id,index) {
	       	const vm = this;
	       	var index = index;
	       	confirm('هل تريد الحذف ؟') && axios.get('/admin/section/destroy/' + id).then(response => {
	       										vm.sections.splice(index,1);
									       	}).catch(err => {
	       										console.log(err)
	       									});
	       	
	       }
		},
		created() {
			const vm = this;
			vm.fetch();
		}
	}
</script>
<style scoped>
    .inputF {
        position: absolute;
        left: -99999px;
    }
</style>
