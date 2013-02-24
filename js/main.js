function getCumualards(departement_num){
    $.when($.getJSON('datas/deputes.json'), $.getJSON('datas/senateurs.json'), $.getJSON('datas/ministres_tries.json')).done(function(data1, data2, data3) {
        //Quand les 3 requêtes sont terminés
        var cumulards = [];
        
        //récupère la liste des députés cumulards du département
        var deputes = data1[0].values;
        $.each(deputes, function(key, val) {
            if(val.departement_num == departement_num){
                cumulards.push(val);
            }
        });
        
        //récupère la liste des sénateurs cumulards du département
        var senateurs = data2[0].values;
        $.each(senateurs, function(key, val) {
            if(val.departement_num == departement_num){
                cumulards.push(val);
            }
        });
        
        //récupère la liste des ministres cumulards du département
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