function getCumualards(departement_num){s
    $.when($.getJSON('datas/deputes.json'), $.getJSON('datas/senateurs.json'), $.getJSON('datas/ministres_tries.json')).done(function(data1, data2, data3) {
        //Quand les 3 requêtes sont terminés
        var cumulards = [];
        var deputes = data1[0].values;

        $.each(deputes, function(key, val) {
            if(val.departement_num == departement_num){
                cumulards.push(val);
            }
        });
        
        var senateurs = data2[0].values;

        $.each(senateurs, function(key, val) {
            if(val.departement_num == departement_num){
                cumulards.push(val);
            }
        });
        
        var ministres = data3[0].values;

        $.each(ministres, function(key, val) {
            if(val.departement_num == departement_num){
                cumulards.push(val);
            }
        });
        console.dir(cumulards);
    });
}
getCumualards('44');

