import * as yup from 'yup';

export default function(data){
  return new Promise((resolve, reject) => {
    let schema = yup.object().shape({
      username: yup.string()
        .required("Harap masukkan username Anda")
        .max(32, "Maksimal nama username adalah 32 karakter"),
      email: yup.string()
        .required("Harap masukkan email Anda")
        .email("Harap masukkan format email yang benar"),
      password: yup.string()
        .required("Masukkan kata sandi Anda"),
      password_confirmation: yup.string()
        .test({
          name: 'password-required-confirmation',
          message: 'Harap konfirmasi kata sandi Anda',
          test: function(value){
            if(!this.parent.password){
              return true;
            }
            return value?.length > 0;
          }
        })
        .required("Masukkan kembali kata sandi Anda")
        .test({
          name: 'password-confirmed',
          message: 'Password tidak sama',
          test: function(value){
            if(!this.parent.password){
              return true;
            }
            return this.parent.password === value
          }
        })
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