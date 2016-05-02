
var FormPdf = function(options){
    this.main = options.target;
    this.collectionHolder = this.main.find('.pdf-list');
    this.addPdfLink = $('<a href="#" class="add-pdf-link">Ajouter un PDF</a>');
    this.newLinkLi = $('<li></li>').append(this.addPdfLink);

    this.init();    
};

FormPdf.prototype =
{
    init : function()
    {   
        var that = this;

        // add the remove button
        this.collectionHolder.find('li').each(function() {
            that.addPdfFormDeleteButton($(this));
        });

        // add the add button
        this.collectionHolder.append(this.newLinkLi);

        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        this.collectionHolder.data('index', this.collectionHolder.find(':input').length);

        this.addPdfLink.on('click', function(e) {
            e.preventDefault();

            // add a new tag form (see next code block)
            that.addPdfForm();
        });
        
            
    },

    addPdfForm : function()
    {

        // Get the data-prototype explained earlier
        var prototype = this.collectionHolder.data('prototype');

        // get the new index
        var index = this.collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        this.collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var newFormLi = $('<li></li>').append(newForm);
        this.newLinkLi.before(newFormLi);


        var newFormPosition = $($(newFormLi)[0]).find('.pdf-position');
        $($(newFormPosition)[0]).attr('value',index + 1);

        this.addPdfFormDeleteButton(newFormLi);
    },

    addPdfFormDeleteButton : function(location)
    {
        this.nbPdf = this.nbPdf - 1;

        var removeFormA = $('<a href="#" class="del-pdf-link" >Supprimer ce PDF</a>');
        location.append(removeFormA);

        removeFormA.on('click', function(e) {
            e.preventDefault();

            // remove the li for the tag form
            location.remove();
        });
    },
};

var DeleteButton = function(options){

    this.main = options.target;
    this.button = this.main.find("[data-delete-id]");
    this.confirmBox = this.main.find("[data-type=confirm-box]");
    this.confirmTitle = this.confirmBox.find("[data-title]");
    this.confirmOk = this.confirmBox.find("[data-type=confirm-ok]");
    this.confirmCancel = this.confirmBox.find("[data-type=confirm-cancel]");
    this.init(options);
};

DeleteButton.prototype =
{
    init : function(options)
    {
        var that = this;
        this.button.on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('data-delete-id');
            var slug = $(this).attr('data-delete-slug');
            var title = $(this).attr('data-delete-title');
            var url = ""+slug+"/delete/"+id;
            that.confirm(this,url,title);
        });
    },

    confirm : function(self,url,title)
    {
        var that = this;
        this.confirmTitle.html(title);
        this.confirmBox.css('display','block');
        this.confirmCancel.on('click', function(e){
            e.preventDefault();
            that.confirmBox.css('display','none');
        });
        this.confirmOk.on('click', function(e){
            e.preventDefault();
            that.deleteAction(url,self);
            that.confirmBox.css('display','none');
        });
    },

    deleteAction : function(url, self)
    {
        $.ajax({
          type: "POST",
          url: url,
          success: function(data){
            console.log(data);
            if ( data == "true" ){
                document.location.reload(true);
            } else {
                alert("Une erreur s'est produite, veuiller réessayer plus tard");
            }
          },
          error: function(){
            alert('Une erreur s\'est produite, veuiller réessayer plus tard');
          }
        });
    }
};


jQuery(document).ready(function() {

    var fromPdf = new FormPdf({ target : $('body') });
    var deleteButton = new DeleteButton({target : $('body')});

});



