$(function(){

    const generator = new Generator();

    generator.init().then(()=>{
        $('.items').removeAttr('hidden');
        const array = generator.getArray();
        array.forEach(el=>{
            $('.items').append("<p class = 'item' id = 'item-"+array.indexOf(el)+"'>"+el+"</p>");
        });

        $('.js-first').click(()=>{
            $('.items').animate({
                scrollTop: $("#item-0").offset().top
            }, 2000);
        });

        $('.js-last').click(()=>{
            $('.items').animate({
                scrollTop: $("#item-"+(array.length-1)).offset().top
            }, 2000);
        });

        $(".js-search").click(()=>{
            let query = $("#search-box").val();

            if(query != ''){
                let found = false;
                array.forEach(el=>{
                   if(el == query){
                        let index = array.indexOf(el);
                        find(index);
                   }
                });
                if(!found){
                    let index = query;
                    if(index < array.length){
                        find(index);
                    }
                }
            }
        })
    });

    function find(index){
        $("#item-"+index).addClass('highlight');
        let position = ($("#item-"+index).offset().top) - ($('.items').height() / 2);
        found = true;

        $('.items').animate({
            scrollTop: position
        }, 2000);

        setTimeout(() => {
            $("#item-"+index).removeClass('highlight');
        }, 5000);
    }

});