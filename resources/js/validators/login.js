import * as yup from 'yup';

export default function(data){
  return new Promise((resolve, reject) => {
    let schema = yup.object().shape({
      username: yup.string()
        .required("Harap masukkan username atau email Anda"),
      password: yup.string()
        .required("Masukkan kata sandi Anda"),
    });
  
    schema.validate(data, {abortEarly: false})
      .then((_) => {
        resolve(true);
      })
      .catch((err) => {
        const bag = {};

        for(let i = 0; i < err.inner.length; i++){
          if(!bag[err.inner[i].path]){
            bag[err.inner[i].path] = err.inner[i].message;
          }
        }
        reject(bag);
      });
  });
}