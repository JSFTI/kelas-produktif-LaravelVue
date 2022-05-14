import fileMimeByMagic from '@/helpers/fileMimeByMagic';
import * as yup from 'yup';

export default function(data){
  return new Promise((resolve, reject) => {
    let schema = yup.object().shape({
      title: yup.string().required("Masukkan judul post Anda"),
      slug: yup.string().matches(/^[a-z0-9]+(?:-?[a-z0-9]*)+$/g, {excludeEmptyString: true, message: 'Format slug tidak benar'}),
      image: yup.mixed().required("Harap berikan foto post"),
      content: yup.string().required("Post harus memiliki isi")
    });
  
    schema.validate(data, {abortEarly: false})
      .then(() => {
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