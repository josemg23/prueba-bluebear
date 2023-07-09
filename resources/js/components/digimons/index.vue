<template>
<div>
    <div class="container">
        <h5 class="text-center">LISTA DE DIGIMONS</h5>
        <main class="content" >
            <div class="row justify-content-end text-justify" >
                <div class="col-md-3 d-flex justify-content-center" v-for="(item, i) in paginatedDigimons" :key="i">
                    <div class="image-container">
                        <img :src="item.image" alt="Imagen" @click="selectItemsContratos(item)" style="width:200px; height:200px" />
                        <p style="margin-bottom: 0;">{{ item.name }} </p>
                    </div>
                </div>
            </div>
        </main> 
        <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" class="mt-4" align="center"></b-pagination>
        <b-modal :adaptive="true" :id="infoModal.id" :title="infoModal.title" @hide="resetInfoModal" hide-footer>
            <div class="row  text-justify">
                <div class="col-md 3" style="text-align: center;text-transform: uppercase;">
                    <p><b>{{ infoModal.ids }}</b></p>
                    <p><b><u>{{ infoModal.name }}</u></b></p>
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <b-img :src="infoModal.img" fluid alt="Responsive image" style="width:200px; height:200px"></b-img>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p><b>Level </b></p>
                    <div v-for="(value, i) in infoModal.levels" :key="i">
                        <p style="font-size: small; margin-bottom: 0;">{{ value.level }} </p>
                    </div>
                </div>
                <div class="col-md-4 " style="text-align: center;">
                    <p><b>Attribute </b></p>
                    <div v-for="(value, i) in infoModal.attributes" :key="i">
                        <p style="font-size: small;margin-bottom: 0;">{{ value.attribute }} </p>
                    </div>
                    <br>
                </div>

                <div class="col-md-4" style="text-align: center;">
                    <p><b>Type</b></p>
                    <div v-for="(value, i) in infoModal.types" :key="i">
                        <p style="font-size: small;margin-bottom: 0;">{{ value.type }} </p>
                    </div>
                </div>

                <div class="col-md-12" style="text-align: center;">
                    <p><b>Fields</b></p>
                    <div v-for="(value, i) in infoModal.fields" :key="i">
                        <b-img :src="value.image" fluid alt="Responsive image"></b-img> <br>
                    </div>
                </div>
            </div>

        </b-modal>
    </div>

</div>
</template>

<script>
export default {
    data() {
        return {
            digimons: [],
            showModal: false,
            fields: [{
                    key: "id",
                    label: "ID",
                    class: "text-center",
                },
                {
                    key: "name",
                    label: "NOMBRE",
                    class: "text-center",
                },
                {
                    key: "actions",
                    label: "",
                    class: "text-center"
                },
            ],
            infoModal: {
                id: "info-modal",
                ids: '',
                title: '',
                name: '',
                img: '',
                attributes: [],
                fields: [],
                levels: [],
                types: [],
            },
            perPage: 10,
            currentPage: 1,
            totalRows: 0,
            countlist: 0,

        };
    },
    watch: {
        'infoModal': function (data) {
            if (data.id) {
                this.getInfoAdicionalDigimon();
            }
        }
    },
    methods: {
        loadData: function () {
            let self = this;
            let url = "/digimons?per_page=all";
            axios.get(url).then(function (response) {
                self.digimons = response.data.content;
                self.totalRows = self.digimons.length;
            });
        },
        selectItemsContratos: function (data, index, button) {
            this.infoModal.title = `Detalle de: ${data.name}`;
            this.infoModal.ids = data.id;
            this.infoModal.name = data.name;
            this.infoModal.img = data.image;
            this.getInfoAdicionalDigimon(data);
            this.$root.$emit('bv::show::modal', this.infoModal.id, button);

        },

        getInfoAdicionalDigimon: function (data) {
            let self = this;
            let url = 'detail-digimons/' + data.id;
            axios.get(url).then(function (response) {
                self.infoModal.attributes = response.data.attributes;
                self.infoModal.fields = response.data.fields;
                self.infoModal.levels = response.data.levels;
                self.infoModal.types = response.data.types;

            });

        },
        addButtonContratos: function () {
            let self = this;
            this.custom_buttons_spot = [{
                text: "Seleccionar ",
                icon: "fa fa-plus",
                color: "#8BC34A",
                link: function (data) {
                    self.selectItemsContratos(data);
                },
            }];
        },
        resetInfoModal() {
            this.infoModal.title = "";
            this.infoModal.name = "";
            this.infoModal.img = "";
            this.infoModal.attributes = [];
            this.infoModal.fields = [];
            this.infoModal.levels = [];
            this.infoModal.types = [];
        },

    },
    computed: {
        paginatedDigimons() {
            let start = (this.currentPage - 1) * this.perPage;
            let end = start + this.perPage;
            return this.digimons.slice(start, end);
        },
    },

    created() {
        this.loadData();
        this.addButtonContratos();

    },

}
</script>

<style>
.content {
    /* Estilos para el contenido */
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
}
</style>
