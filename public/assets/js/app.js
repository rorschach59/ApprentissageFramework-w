// Pour gèrer l'autocomplétion, à l'aide du typeahead.bundle.js
var citynames = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    // défini l'url ou l'on récupére nos données sources
    url: 'http://localhost/Framework-W/public/article/categories.json',
    cache: false
    }
});
citynames.initialize();

$('.tagsinput').tagsinput({
  typeaheadjs: {
    name: 'citynames',
    displayKey: 'name',
    valueKey: 'name',
    source: citynames.ttAdapter()
  }
});
