<template>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Province</label>
            <multiselect v-model="form.province_id" track-by="id" :allow-empty="false" placeholder="Select Province"
                         :multiple="false" label="name" @select="loadDistricts"
                         :options="provinces"></multiselect>
        </div>
        <div class="form-group col-md-4">
            <label>District</label>
            <multiselect v-model="form.district_id" track-by="id" :allow-empty="false" placeholder="Select District"
                         :multiple="false" label="name" @select="loadSectors"
                         :options="districts"></multiselect>
        </div>
        <div class="form-group col-md-4">
            <label>Sector</label>
            <multiselect v-model="form.sector_id" track-by="id" :allow-empty="false" placeholder="Select Sector"
                         :multiple="false" label="name" @select="loadCells"
                         :options="sectors"></multiselect>
        </div>
        <div class="form-group col-md-6">
            <label>Cell</label>
            <multiselect v-model="form.cell_id" track-by="id" :allow-empty="false" placeholder="Select Cell"
                         :multiple="false" label="name" @select="loadVillages"
                         :options="cells"></multiselect>
        </div>
        <div class="form-group col-md-6">
            <label>Village</label>
            <multiselect v-model="form.village_id" track-by="id" :allow-empty="false" placeholder="Select Village"
                         :multiple="false" label="name"
                         :options="villages"></multiselect>
        </div>
        <input type="hidden" :value="form.province_id?form.province_id.id:''" name="province_id">
        <input type="hidden" :value="form.district_id?form.district_id.id:''" name="district_id">
        <input type="hidden" :value="form.sector_id?form.sector_id.id:''" name="sector_id">
        <input type="hidden" :value="form.cell_id?form.cell_id.id:''" name="cell_id">
        <input type="hidden" :value="form.village_id?form.village_id.id:''" name="village_id">
    </div>
</template>

<script>

    import Multiselect from "vue-multiselect";

    export default {
        name: "UserAddress",
        components: {Multiselect},
        data() {
            return {
                provinces: [],
                districts: [],
                sectors: [],
                cells: [],
                villages: [],
                form: {
                    province_id: '',
                    district_id: '',
                    sector_id: '',
                    cell_id: '',
                    village_id: '',
                }
            }
        },
        methods: {
            loadProvinces() {
                this.$Progress.start();
                axios.get("/api/provinces")
                    .then(resp => {
                        this.$Progress.finish();
                        this.provinces = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadDistricts(selected) {
                this.$Progress.start();
                axios.get(`/api/districts/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.districts = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadSectors(selected) {
                this.$Progress.start();
                axios.get(`/api/sectors/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.sectors = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadCells(selected) {
                this.$Progress.start();
                axios.get(`/api/cells/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.cells = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadVillages(selected) {
                this.$Progress.start();
                axios.get(`/api/villages/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.villages = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
        },
        created() {
            this.loadProvinces();
        }
    }
</script>

<style scoped>

</style>
