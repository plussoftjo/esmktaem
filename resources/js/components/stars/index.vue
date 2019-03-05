<template>
	<div class="stars">
		<v-card>
			<v-card-title class="yellow darken-2">
				<div class="font-weight-black title">
					قائمة النجوم
				</div>
				<v-spacer></v-spacer>
				<v-btn class="green darken-2"  dark flat @click="dialog=!dialog">+ اضافة مشهور	</v-btn>
			</v-card-title>
		</v-card>
		<v-card>
			<v-card-title>
		     
		      <v-spacer></v-spacer>
		      <v-text-field
		        v-model="search"
		        append-icon="search"
		        label="بحث"
		        solo	
		        single-line
		        hide-details
		      ></v-text-field>
		    </v-card-title>
		    <v-data-table
		      :headers="headers"
		      :items="stars"
		      :search="search"
		      class="font-weight-black"
		    >
		      <template slot="items" slot-scope="props" >
		        <td class="text-xs-center" @click="$router.push({name:'نجم',params:{id:props.item.id}})">{{ props.item.id }}</td>
		        <td class="text-xs-center ">{{ props.item.name }}</td>
		      </template>
		      <v-alert slot="no-results" :value="true" color="error" icon="warning">
		        لا يوجد نتائج بحث بهاذا الاسم
		      </v-alert>
		    </v-data-table>
		</v-card>

		<v-dialog v-model="dialog" max-width="500px">
			<v-card>
				<v-card-title class="primary white--text">
					اضافة ممشهور
				</v-card-title>
				<v-card-title>
					<div style="width: 100%;">
						<v-text-field
						label="اسم المشهور"
						solo
						v-model="star.name"></v-text-field>
					</div>
					<div>
						<v-btn class="pink darken-3" dark @click="openImage"><v-icon>attachment</v-icon>اضافة صورة للمشهور</v-btn>
					</div>
					<div class="inputF">
						<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
					</div>
					<div style="width: 100%;">
						<v-btn class="success" @click="store">حفظ</v-btn>
						<v-btn>الغاء</v-btn>
					</div>
				</v-card-title>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				dialog:false,
				star:{name:'',image:''},
				stars:[],
				search:'',
				headers:[
				{text:'الرقم التعريفي',value:'id',align:'center'},
				{text:'الاسم',value:'name',align:'center'},
				]
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
	              vm.star.image = e.target.result;
	          };
	          reader.readAsDataURL(file);
	       },
	       store() {
	       	const vm = this;
	       	axios.post('/admin/stars/store',vm.star).then(response => {

	       	}).catch(err => {
	       		console.log(err)
	       	});
	       },
	       install() {
	       	const vm = this;
	       	axios.get('/admin/stars/index').then(response => {
	       		vm.stars = response.data;
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
        position: fixed;
        left: -99999px;
    }
</style>
