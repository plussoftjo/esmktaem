<template>
	<div class="markets">
		<v-card class="pink">
			<v-card-title class="font-weight-black white--text title">
				محلات
				<v-spacer></v-spacer>
				<v-btn class="success font-weight-black" @click="dialog = !dialog">+اضافة محل</v-btn>
			</v-card-title>
		</v-card>
		<v-card>
			
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
		      :items="markets"
		      :search="search"
		      class="font-weight-black"
		    >
		      <template slot="items" slot-scope="props" >
		        <td class="text-xs-left" @click="$router.push({name:'market',params:{id:props.item.id}})">{{ props.item.user.name }}</td>
		        <td class="text-xs-left ">{{ props.item.user.phone }}</td>
		        <td class="text-xs-left ">{{ props.item.country }}</td>
		        <td class="text-xs-left ">{{ props.item.city }}</td>
		        <td class="text-xs-left ">
		        	<v-btn icon @click="() => {editDialog = true; market = props.item;}">
		        		<v-icon class="blue--text" >
							build
						</v-icon>
		        	</v-btn>

					<v-btn icon @click="destroy(props.item.id)">
						<v-icon class="red--text" >
						delete
					</v-icon>
					</v-btn>

					
		        </td>
		      </template>
		      <v-alert slot="no-results" :value="true" color="error" icon="warning">
		        لا يوجد نتائج بحث بهاذا الاسم
		      </v-alert>
		    </v-data-table>
		</v-card>


		</v-card>
		<v-dialog v-model="dialog" max-width="600px">
			<v-card>
				<v-card-title class="success white--text" >
					اضافة محلا جديد
					<v-spacer></v-spacer>
					<v-btn class="red" icon dark @click="dialog = !dialog;">X</v-btn>
				</v-card-title>
				<v-card-title>
					<v-layout row wrap>
						<v-flex md6>
							<v-text-field
							label="رقم الهاتف"
							solo
							v-model="market.phone"></v-text-field>
						</v-flex>
						<v-flex md6>
							<v-text-field
							label="رقم سري"
							solo
							v-model="market.password"
							password></v-text-field>
						</v-flex>
						<v-flex md6>
							<v-text-field
							label="اسم المحل"
							v-model="market.name"
							solo></v-text-field>
						</v-flex>
						<v-flex md6>
							<v-select
							:items="sections"
							label="القسم"
							solo
							v-model="section"></v-select>
						</v-flex>
						<v-flex md6>
							<v-select
							:items="catgs"
							label="الفئات"
							solo
							multiple
							v-model="market.catg"></v-select>
						</v-flex>
						<v-flex md6>
							<v-select
							:items="rates"
							v-model="market.rate"
							solo
							label="التقيم"></v-select>
						</v-flex>
						<v-flex md6>
							<v-select
							:items="countrys"
							label="الدولة"
							solo
							v-model="country"></v-select>
						</v-flex>
						<v-flex md6>
							<v-select
							:items="city"
							label="المدينة"
							solo
							v-model="market.city"></v-select>
						</v-flex>
						<v-flex md12>
							<v-textarea
							label="وصف"
							solo
							v-model="market.des"></v-textarea>
						</v-flex>
						<v-flex md4>
							<div>
								<v-btn class="blue" @click.native="openImage" block dark><v-icon>attachment</v-icon>تغير الصورة</v-btn>
								<div class="inputF">
									<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
								</div>
							</div>
						</v-flex>
						<v-flex md12	>
							<v-btn class="success" block @click="store">حفظ</v-btn>
						</v-flex>
					</v-layout>
				</v-card-title>
			</v-card>
		</v-dialog>
		<v-dialog v-model="editDialog" max-width="600px">
			<v-card v-if="editDialog">
				<v-card-title class="success white--text" >
					اضافة محلا جديد
					<v-spacer></v-spacer>
					<v-btn class="red" icon dark @click="editDialog = !editDialog;">X</v-btn>
				</v-card-title>
				<v-card-title>
					<v-layout row wrap>
						<v-flex md6>
							<v-text-field
							label="رقم الهاتف"
							solo
							v-model="market.user.phone"></v-text-field>
						</v-flex>
						<v-flex md6>
							<v-text-field
							label="اسم المحل"
							v-model="market.user.name"
							solo></v-text-field>
						</v-flex>
						<v-flex md12>
							<v-textarea
							label="وصف"
							solo
							v-model="market.des"></v-textarea>
						</v-flex>
						<v-flex md4>
							<v-card>
								<v-img
								:src="market.logo"
								height="100px" contain></v-img>
							</v-card>
							<div>
								<v-btn class="blue" @click.native="openImageUpdate" block dark><v-icon>attachment</v-icon>تغير الصورة</v-btn>
								<div class="inputF">
									<input type="file" v-on:change="onFileChangeUpdate" class="form-control" ref="imageUpdate">
								</div>
							</div>
						</v-flex>
						<v-flex md12	>
							<v-btn class="success" block @click="update">تحديث</v-btn>
						</v-flex>
					</v-layout>
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
				market:{},
				city:[],
				countrys:[],
				country:'',
				sections:[],
				markets:[],
				search:'',
				headers:[
				{text:'اسم المحل ',value:'name'},{text:'رقم الهاتف ',vlaue:'phone'},{text:'الدولة',value:'country'},{text:'المدينة',value:'city'},{text:'تعديل',value:'edit'}
				],
				editDialog:false,
				section:null,
				catgs:[],
				rates:[1,1.5,2,2.5,3,3.5,4,4.5,5]
			}
		},
		methods:{
			install() {
				const vm = this
				axios.get('admin/country/index').then(response => {
					response.data.forEach(trg => {
						vm.countrys.push(trg.name)
					});
				}).catch(err => {
					console.log(err)
				});

				axios.get('admin/section/index').then(response => {
					response.data.forEach(trg => {
						vm.sections.push(trg.title)
					});
				}).catch(err => {
					console.log(err)
				});

				axios.get('admin/market/index').then(response => {
					vm.markets = response.data;
				}).catch(err => {
					console.log(err)
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
	              vm.market.image = e.target.result;
	          };
	          reader.readAsDataURL(file);
	       },
	       openImageUpdate() {
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
	              vm.changeImage(e.target.result)
	          };
	          reader.readAsDataURL(file);
	       },
	       store() {
	       	const vm = this;

	       	vm.market.country = vm.country;
	       	vm.market.section = vm.section;
	       	vm.market.catgs = vm.market.catg.toString();
	       	axios.post('/admin/market/store',vm.market).then(response => {
	       		console.log(response.data)
	       	}).catch(err => {
	       		console.log(err)
	       	});
	       },
	       changeImage(e)
	       {
	       	const vm = this;
	       	axios.post('admin/market/changeImage/' + vm.market.id,{image:e}).then(response => {
	       		vm.market.logo = response.data.image
	       	}).catch(err => {
	       		console.log(err)
	       	});
	       },
	       update() {
	       	const vm = this;
	       	axios.post('admin/market/update/' + vm.market.id,vm.market).then(response => {
	       		location.reload()
	       	}).catch(err => {
	       		console.log(err)
	       	});
	       },
	       destroy(id) {
	       	const vm  = this;
	       	confirm('هل تريد الحذف ? ') && axios.post('admin/market/destroy/' + id).then(response => {
	       		location.reload();
	       	}).catch(err => {
	       		console.log(err)
	       	});;
	       }
		},
		created() {
			const vm = this;
			vm.install();
		},
		watch:{
			country() {
				const vm = this;
				axios.post('admin/city/withCountry',{country:vm.country}).then(response => {
					response.data.forEach(trg => {
						vm.city.push(trg.name);
						console.log(trg)
					});
				}).catch(err => {
					console.log(err)
				});

			},
			section() {
				const vm = this;
				axios.post('admin/catg/withSection',{section:vm.section}).then(response => {
					response.data.forEach(trg => {
						vm.catgs.push(trg.title)
					});
				}).catch(err => {
					console.log(err)
				});
			}
		}
	}
</script>
<style scoped>
    .inputF {
        position: fixed;
        left: -99999px;
    }
</style>
