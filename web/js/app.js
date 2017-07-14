new Vue({
    delimiters: ['${', '}'],
    el: 'main',
    data () {
        return {
            asesores: [],
            carreras: [],
            nuevoasesor: false
        }
    },
    mounted () {
        this.fetchAsesores(),
        this.fetchCarreras()
    },
    methods: {
      fetchAsesores () {
        axios.get('/api/asesores')
             .then(response => {
                this.asesores = response.data.asesores
             }
        )
      },
      fetchCarreras () {
        axios.get('/api/carreras')
             .then(response => {
                this.carreras = response.data.carreras
             }
        )
      },
      selectAsesor () {
        this.nuevoasesor = false
      }
    }
})