document.getElementById("assetForm").addEventListener("submit", function(event){
    let isValid = true;
    let assetType = document.getElementById("asset_type").value;
    let assetCode = document.getElementById("assetCode").value;
    let manufacturer = document.getElementById("manufacturer").value;
    let supplier = document.getElementById("supplier").value;
    let invoice = document.getElementById("invoice").value;
    let price = document.getElementById("price").value;
    let depreBegin = document.getElementById("depreBegin").value;
    let lifetime = document.getElementById("lifetime").value;
    let depreRate = document.getElementById("depreRate").value;
    let warrantyCode = document.getElementById("warrantyCode").value;
    let warrantyStart = document.getElementById("warrantyStart").value;
    let warrantyEnd = document.getElementById("warrantyEnd").value;
    let installationDate = document.getElementById("installationDate").value;
    let serviceInterval = document.getElementById("serviceInterval").value;

    if(assetType === "Select item"){
        isValid = false;
        document.getElementById("assetTypeErr").style.display = "block";
    }
    if(assetCode === ""){
        isValid = false;
        document.getElementById("assetCodeErr").style.display = "block";
    }
    if(manufacturer === "Select item"){
        isValid = false;
        document.getElementById("manufacturerErr").style.display = "block";
    }
    if(supplier === "Select item"){
        isValid = false;
        document.getElementById("supplierErr").style.display = "block";
    }
    if(price === ""){
        isValid = false;
        document.getElementById("priceErr").style.display = "block";
    }
    if(depreRate === ""){
        isValid = false;
        document.getElementById("depreRateErr").style.display = "block";
    }
    if(depreBegin === ""){
        isValid = false;
        document.getElementById("depreBeginErr").style.display = "block";
    }
    if(serviceInterval === ""){
        isValid = false;
        document.getElementById("serviceIntervalErr").style.display = "block";
    }
    if(lifetime === ""){
        isValid = false;
        document.getElementById("lifetimeErr").style.display = "block";
    }
    if(installationDate === ""){
        isValid = false;
        document.getElementById("installationDateErr").style.display = "block";
    }
    if(isValid){
        $("#assetForm").attr('method', 'POST');
        $("#assetForm").attr('action', './includes/nonCurrentAssetForm-inc.php');
    }
    else{
        event.preventDefault();
    }
});

document.getElementById("asset_type").addEventListener("change", function(event){
    document.getElementById("assetTypeErr").style.display = "none";
});
document.getElementById("assetCode").addEventListener("keyup", function(event){
    document.getElementById("assetCodeErr").style.display = "none";
});
document.getElementById("manufacturer").addEventListener("change", function(event){
    document.getElementById("manufacturerErr").style.display = "none";
});
document.getElementById("supplier").addEventListener("change", function(event){
    document.getElementById("supplierErr").style.display = "none";
});
document.getElementById("price").addEventListener("keyup", function(event){
    document.getElementById("priceErr").style.display = "none";
});
document.getElementById("price").addEventListener("change", function(event){
    document.getElementById("priceErr").style.display = "none";
});
document.getElementById("depreRate").addEventListener("change", function(event){
    document.getElementById("depreRateErr").style.display = "none";
});
document.getElementById("serviceInterval").addEventListener("keyup", function(event){
    document.getElementById("serviceIntervalErr").style.display = "none";
});
document.getElementById("serviceInterval").addEventListener("change", function(event){
    document.getElementById("serviceIntervalErr").style.display = "none";
});
document.getElementById("depreBegin").addEventListener("change", function(event){
    document.getElementById("depreBeginErr").style.display = "none";
});
document.getElementById("lifetime").addEventListener("keyup", function(event){
    document.getElementById("lifetimeErr").style.display = "none";
});
document.getElementById("installationDate").addEventListener("keyup", function(event){
    document.getElementById("installationDateErr").style.display = "none";
});