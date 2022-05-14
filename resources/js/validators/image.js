import fileMimeByMagic from '@/helpers/fileMimeByMagic';
import * as yup from 'yup';

export default function(image){
  return new Promise((resolve, reject) => {
    let imageTest = yup.mixed().nullable()
      .test({
        name: 'file-is-image',
        message: 'Berkas bukan merupakan foto',
        test: async function(value){
          if(value === null || value === undefined){
            return true;
          }
          if(/image\/.*/.test(await fileMimeByMagic(value))){
            return true;
          }
        }
      });

    imageTest.validate(image, {abortEarly: false})
      .then(() => {
        resolve(true);
      })
      .catch((err) => {
        reject(err.message);
      });
    
    if(imageTest.validate()){

    }
  });
}