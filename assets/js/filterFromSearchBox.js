
buildTable(records);
    $('#searchInput').on('keyup', function(){
        var value = $(this).val();
        console.log('value: ' + value);
        var filteredInfo = filterData(value);
        buildTable(filteredInfo);
    })

    function filterData(value){
        var filteredInfo = [];
        for (let i = 0; i < records.length; i++) {
            value = value.toLowerCase();
            var assetId = records[i].asset_id.toLowerCase();
            var assetType = records[i].asset_type.toLowerCase();
            var lifeTime = records[i].life_time;
            var manu = records[i].manu.toLowerCase();
            var serviceInterval = records[i].service_interval;
            var lifeTime = records[i].carrying_value;

            if(assetId.includes(value) || assetType.includes(value) || manu.includes(value)){
            filteredInfo.push(records[i]);
            }
            
        }
        return filteredInfo;
    }

    function buildTable(records){
        let tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = '';
        for (let i = 0; i < records.length; i++) {
            var row = `<tr>
                        <td> ${records[i].asset_id} </td>
                        <td> ${records[i].asset_type} </td>
                        <td> ${records[i].life_time} </td>
                        <td> ${records[i].manu} </td>
                        <td> ${records[i].service_interval} </td>
                        <td> ${records[i].carrying_value} </td>
                        </tr>`;
            tableBody.innerHTML += row;
        }    
    }