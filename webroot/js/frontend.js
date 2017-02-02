
function onPropertyCategorySelect(select) {
    var selectedType = $("#search-property-type").val();
    var categoryId = $(select).data("category-id");
    if (!categoryId) {
        $("#search-property-type").val('').find("option[value!='']").show().prop('disabled', false);
    } else {
        $("#search-property-type").val('').find("option[value!='']").hide().prop('disabled', true).filter('[data-property-category-id=' + categoryId + ']').show().prop('disabled', false);;
    }
    if (selectedType && $("#search-property-type option[value=" + selectedType + "]")
        .attr("data-property-category-id") == categoryId) {
        $("#search-property-type").val(selectedType);
    }
}
$(function(){
    var checkedCategory = $("input[name=property-category]:checked");
    if(checkedCategory.length > 0) {
        onPropertyCategorySelect(checkedCategory);
    }

    $("#search-property-type").on("change", function(){
        var category = $(this).find(":selected").attr("data-property-category-id");
        if (category && category != "" && category !=1) {
            $("#search-bedrooms").val('').attr("disabled", "disabled");
        } else {
            $("#search-bedrooms").removeAttr("disabled");
        }
        console.log(this);
    });
});