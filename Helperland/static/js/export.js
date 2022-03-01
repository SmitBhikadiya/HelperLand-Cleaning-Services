$(document).ready(function(){
    $(".export").click(function(){
        $("table").table2csv({
            separator: ',',
            newline: '\n',
            quoteFields:true,
            excludeColumns: 'th',
            excludeRows: 'thead tr',
            filename: 'table.csv'
        });
    });
});