class Generator{

    chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    array = [];

    constructor(){

    }

    init(){
        return new Promise((resolve,reject)=>{

            setTimeout(() => {
                let count =  Math.floor(Math.random()*500) + 500; 
    
                for(let i = 0; i < count; i++){
                    this.array.push(this.getString());
                }
    
                setTimeout(() => {
                    resolve('true');
                }, 1000);
            }, 1000);
           }
        );
    }

    getArray(){
        return this.array;
    }

    getString(){

       let length = Math.floor(Math.random()*10) + 5; 
       let string = '';

       for(let i = 0; i < length; i++){
            string += this.chars.charAt(Math.floor(Math.random() * this.chars.length));
            i++;
       }

       return string;
    }

}