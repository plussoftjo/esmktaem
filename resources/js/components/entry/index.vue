<template>
	<div class="entry">
		<v-card>
			<v-card-title class="yellow darken-2">
				<div class="font-weight-black title">
					طلبات التوثيق
				</div>
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
		      :items="entrys"
		      :search="search"
		      class="font-weight-black"
		    >
		      <template slot="items" slot-scope="props" >
		        <td class="text-xs-center ">{{ props.item.id }}</td>
		        <td class="text-xs-center ">{{ props.item.user.name }}</td>
		        <td class="text-xs-center "><v-btn icon @click="() => {dialog = true; entry = props.item}"><v-icon class="blue--text">pageview</v-icon></v-btn></td>
		      </template>
		      <v-alert slot="no-results" :value="true" color="error" icon="warning">
		        لا يوجد نتائج بحث بهاذا الاسم
		      </v-alert>
		    </v-data-table>
		</v-card>

		<v-dialog v-model="dialog" max-width="400px"> 
			<v-card v-if="dialog" class="primary">
				<v-card-title class="font-weight-black title white--text">
					طلب توثيق
				</v-card-title>
				<v-card-title class="text-xs-right">
					<div style="background-color: rgba(0,0,0,0.3); color: white; width: 100%;" class="font-weight-black pa-1 ma-1">
						<span class="title">اسم صاحب الطلب </span> -  {{entry.user.name}} 
					</div>
					<div style="background-color: rgba(0,0,0,0.3); color: white; width: 100%;" class="font-weight-black pa-1 ma-1">
						<span class="title">رقم هاتف صاحب الطلب</span> -  {{entry.user.phone}} 
					</div>
					<div style="background-color: rgba(0,0,0,0.3); color: white; width: 100%;" class="font-weight-black pa-1 ma-1">
						<span class="title">رسالة</span> -  {{entry.msg}} 
					</div>
				</v-card-title>
				<v-container text-xs-center grid-list-md>
					<v-layout row wrap>
						<v-flex xs12 md6>
							<v-btn class="success" block @click="approve">توثيق</v-btn>
						</v-flex>
						<v-flex xs12 md6>
							<v-btn block @click="dialog = false; entry = {};"> 
								اغلاق
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
				headers:[
				{text:'رقم الطلب',value:'id',align:'center'},
				{text:'الاسم',value:'name',align:'center'},
				{text:'show',value:'name',align:'center'},
				],
				search:'',
				entrys:[],
				entry:{},
				dialog:false
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('entry/index').then(response => {
					vm.entrys = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			approve() {
				const vm = this;
				axios.get('entry/approve/' + vm.entry.id).then(response => {
					location.reload();
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
<style>
	
</style>