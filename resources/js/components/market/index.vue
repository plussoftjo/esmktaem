<template>
	<div class="market" v-if="market">
		<v-container grid-list-md fill-height justify-center>
			<v-layout row wrap justify-center>
				<v-flex xs12 md8 lg8>
					<v-card>
						<v-card-title class="white--text blue darken-4">
							<span class="title font-weight-black">
								اسم المحل  :
							</span>
							<span class="pr-2">
								 {{market.user.name}}
							</span>
						</v-card-title>
						<v-card-title>
							<v-btn class="red darken-4" dark @click="dialog = !dialog">
								اضافة طبق
							</v-btn>
							<div style="width: 100%;">
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
							      :items="items"
							      :search="search"
							      class="font-weight-black"
							    >
							      <template slot="items" slot-scope="props" >
							        <td class="text-xs-right" @click="selectItem(props.item)">{{ props.item.id }}</td>
							        <td class="text-xs-right " @click="selectItem(props.item)">{{ props.item.title }}</td>
							        <td class="text-xs-right ">{{ props.item.price }}</td>
							        <td class="text-xs-right ">{{ props.item.catg }}</td>
							      </template>
							      <v-alert slot="no-results" :value="true" color="error" icon="warning">
							        لا يوجد نتائج بحث بهاذا الاسم
							      </v-alert>
							    </v-data-table>
							</v-card>
							</div>
						</v-card-title>
					</v-card>	
				</v-flex>
				<v-flex md4 >
					<v-card v-if="si">
					<v-card-title class="white--text blue ">
						<div class="title font-weight-black">
							المادة
						</div>
					</v-card-title>
					<v-card-title class="text-xs-right">
						<div style="width: 100%;">
							<span class="font-weight-black title ">
								اسم المادة
							</span>
							<span class="title">
								{{si.title}}
							</span>	
						</div>
						<div style="width: 100%;">
							<span class="font-weight-black title ">
								السعر
							</span>
							<span class="title">
								{{si.price}}
							</span>	
						</div>
						<div style="width: 100%;">
							<span class="font-weight-black title ">
								الفئة
							</span>
							<span class="title">
								{{si.catg}}
							</span>	
						</div>
					</v-card-title>

					<v-card-title class="blue white--text font-weight-black title">
						الخيارات
						<v-spacer></v-spacer>
						<v-btn icon class="success font-weight-black white--text" @click="optionsDialog = !optionsDialog">+</v-btn>
					</v-card-title>
						<v-card class="grey lighten-1 text-xs-center font-weight-black">
								<v-layout row wrap >
									<v-flex xs4>
										العنوان
									</v-flex>
									<v-flex xs4>
										النوع
									</v-flex>
									<v-flex xs4>
										حذف
									</v-flex>
								</v-layout>	
						</v-card>
						<v-card v-for="i in si.options" :key="i.id" class="grey lighten-3 text-xs-center">
							<v-layout row wrap >
								<v-flex xs4>
									{{i.title}}
								</v-flex>
								<v-flex xs4>
									{{i.type}}
								</v-flex>
								<v-flex xs4>
									<v-icon class="red--text">delete</v-icon>
								</v-flex>
							</v-layout>	
						</v-card>
					</v-card>
				</v-flex>
			</v-layout>
		</v-container>
		
		
		<v-dialog v-model="dialog" max-width="500px">
			<v-card>

				<v-card-title class="blue darken-4 white--text title font-weight-black">
					اضافة مادة
				</v-card-title>
				<v-container grid-list-md>
				<v-layout row wrap>
					<v-flex xs12>
						<v-text-field
						label="اسم الطبق"
						solo
						v-model="item.title"></v-text-field>
					</v-flex>
					<v-flex xs12>
						<v-select
						:items="catgs"
						label="الفئة"
						v-model="item.catg"
						solo></v-select>
					</v-flex>
					<v-flex xs12>
						<v-text-field
						label="السعر"
						solo
						v-model="item.price"></v-text-field>
					</v-flex>
					<v-flex xs12>
						<v-textarea
						label="وصف"
						solo
						v-model="item.des"></v-textarea>
					</v-flex>
					<v-flex xs12 md8>
						<v-btn class="blue" @click.native="openImage" dark><v-icon>attachment</v-icon>تغير الصورة</v-btn>
						<div class="inputF">
							<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
						</div>	
					</v-flex>
					<v-flex xs6>
						<v-btn class="success" block @click="store">
							حفظ
						</v-btn>
					</v-flex>
					<v-flex xs6>
						<v-btn @click="dialog = !dialog" block>
							الغاء
						</v-btn>
					</v-flex>
				</v-layout>	
				</v-container>
			</v-card>
		</v-dialog>


		
		<v-dialog v-model="optionsDialog" max-width="400px">
			<v-card>
				<v-card-title class="blue font-weight-black white--text title text-xs-right">
					اضافة خيارات
				</v-card-title>
				<v-container grid-list-md >
					<v-layout row wrap>
						<v-flex xs12 md12>
							<v-select
							:items="optionType"
							solo
							label="النوع"
							v-model="option.type"></v-select>
						</v-flex>
						<v-flex xs12 md12>
							<v-text-field
							label="عنوان الخيار"
							solo
							v-model="option.title"></v-text-field>
						</v-flex>
						<hr>
						<v-flex xs12 md12 v-if="option.type == 'عدة اختيارات'">
							<v-card-title class="blue white--text font-weight-black text-xs-right">
								اضافة خيارات
								<v-spacer></v-spacer>
								<v-btn class="success font-weight-black" icon @click="pushOptionList">+</v-btn>
							</v-card-title>
						</v-flex>
						<v-flex xs12 md12 v-if="option.type == 'اختيار واحد'">
							<v-text-field
							label="السعر الاضافي"
							solo
							v-model="option.price"></v-text-field>
						</v-flex>
						<v-layout v-for="(optionList,index) in optionList" :key="index" v-if="option.type == 'عدة اختيارات'">
							<v-flex md8>
								<v-text-field
								label="عنوان"
								v-model="optionList.title"
								solo></v-text-field>
							</v-flex>
							<v-flex md4>
								<v-text-field
								label="السعر"
								solo
								v-model="optionList.price"></v-text-field>
							</v-flex>
						</v-layout>
						<v-flex md6>
							<v-btn class="success font-weight-black" dark block @click="storeOption">
								حفظ
							</v-btn>
						</v-flex>
						<v-flex md6>
							<v-btn class="font-weight-black" block @click="optionsDialog = !optionsDialog">
								الغاء
							</v-btn>
						</v-flex>
					</v-layout>
				</v-container>
			</v-card>
		</v-dialog>


	</div>
</template>
<script>
	export default {
		data() {
			return {
				market:null,
				catgs:null,
				item:{},
				dialog:false,
				search:'',
				items:[],
				headers:[
				{text:'id',align:'right',sortable:false,value:'id'},
				{text:'title',align:'right',sortable:false,value:'title'},
				{text:'price',align:'right',sortable:false,value:'price'},
				{text:'catg',align:'right',sortable:false,value:'catg'},
				],
				si:null,
				optionList:[{title:'',price:''}],
				option:{},
				optionsDialog:false,
				optionType:['اختيار واحد','عدة اختيارات']
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('admin/market/show/' + vm.$route.params.id).then(response => {
					vm.market = response.data;
					var catgs = vm.market.catgs;
					vm.items = response.data.items
					vm.catgs = catgs.split(',');
				}).catch(err => {
					console.log(err)
				});

				
			},
			store() {
				const vm = this;
				axios.post('admin/item/store/' + vm.$route.params.id,vm.item).then(response => {
					console.log(response)
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
	              vm.item.image = e.target.result;
	          };
	          reader.readAsDataURL(file);
	       },
	       selectItem(i){
	       	const vm = this;
	       	vm.si = i;

	       },
	       pushOptionList() {
	       	const vm = this;
	       	vm.optionList.push({title:'',price:''})
	       },
	       storeOption() {
	       	const vm = this;
	       	axios.post('admin/item/option/store/' + vm.si.id,{option:vm.option,optionList:vm.optionList}).then(response => {
	       		vm.optionsDialog = false;
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
