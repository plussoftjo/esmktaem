<template>
	<div class="city">
		<v-layout row wrap>
			<v-flex xs6>
				<v-card class="pink white--text">
					<v-card-title>
						اضافة مدينة
					</v-card-title>
				</v-card>
				<v-card class="pink lighten-2">
					<v-card-title>
						<div style="width: 100%;">
							<v-text-field
							label="اسم المدينة"
							solo
							v-model="city.name"></v-text-field>
						</div>
						<div style="width: 100%;">
							<v-select
							:items="countrys"
							label="الدولة"
							v-model="city.country"
							solo></v-select>
						</div>
						<div style="width: 100%;">
							<v-btn class="success" block @click="store">حفظ</v-btn>
						</div>
					</v-card-title>
				</v-card>
			</v-flex>
			<v-flex xs6>
				<v-card class="pink white--text">
					<v-card-title>
						المدن
					</v-card-title>
				</v-card>
				<v-card class="pink white--text">
						<v-card>
							<v-card-title>
								<v-layout row wrap>
									<v-flex xs4>
										<div class="font-weight-black">الاسم</div>
									</v-flex>
									<v-flex xs4>
										<div class="font-weight-black">الدولة</div>
									</v-flex>
									<v-flex xs4>
										<div class="font-weight-black">
											تعديل
										</div>
									</v-flex>
								</v-layout>
							</v-card-title>
						</v-card>
						<v-card v-for="c in citys" :key="c.id">
							<v-card-title>
								<v-layout row wrap>
									<v-flex xs4>
										<div class="font-weight-black">
											{{c.name}}
										</div>
									</v-flex>
									<v-flex xs4>
										<div class="font-weight-black">
											{{c.country}}
										</div>
									</v-flex>
									<v-flex xs4>
										<div class="font-weight-black">
											تعديل
										</div>
									</v-flex>
								</v-layout>
							</v-card-title>
						</v-card>
				</v-card>
			</v-flex>
		</v-layout>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				city:{},
				countrys:[],
				citys:[]
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('admin/city/index').then(response => {
					vm.citys = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			installCountry() {
				const vm = this;
				axios.get('admin/country/index').then(response => {
					response.data.forEach(trg => {
						vm.countrys.push(trg.name);
					});
				}).catch(err => {
					console.log(err)
				});
			},
			store() {
				const vm = this;
				axios.post('admin/city/store',vm.city).then(response => {
					vm.citys.push(response.data);
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
			vm.installCountry();
		}
	}
</script>