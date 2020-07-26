class Scripts{

    addScripts(){
   
         window.location.origin
        let bootstrap = document.createElement('script')
        let jqueryEasing = document.createElement('script')
        let ruangAdmin = document.createElement('script')
        // let chart = document.createElement('script')
        let chartAreaDemo = document.createElement('script')

        bootstrap.setAttribute('src', baseUrl+'/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')
        jqueryEasing.setAttribute('src', baseUrl+'/backend/vendor/jquery-easing/jquery.easing.min.js')
        ruangAdmin.setAttribute('src', baseUrl+'/backend/js/ruang-admin.min.js')
        // chart.setAttribute('src', 'http://localhost:8000/backend/vendor/chart.js/Chart.min.js')
        chartAreaDemo.setAttribute('src', baseUrl+'/backend/js/demo/chart-area-demo.js')

        document.body.appendChild(bootstrap)
        document.body.appendChild(jqueryEasing)
        document.body.appendChild(ruangAdmin)
        // document.body.appendChild(chart)
        document.body.appendChild(chartAreaDemo)

    }
   

   }
   
export default Scripts = new Scripts();