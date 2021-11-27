document.getElementById("assetForm").addEventListener("submit", function(event){
    event.preventDefault();
    let isValid = true;
    let assetType = document.getElementById("asset_type").value;
    let assetCode = document.getElementById("assetCode").value;
    let manufacturer = document.getElementById("manufacturer").value;
    let serialNo = document.getElementById("serialNo").value;
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
        document.getElementById("manufacturerErr").style.display = "block";
    }
    if(isValid){
        document.getElementById("assetForm").method = "post";
        document.getElementById("assetForm").submit();
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
