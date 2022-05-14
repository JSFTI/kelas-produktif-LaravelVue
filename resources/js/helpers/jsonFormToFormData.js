export default function(data){
  const formData = new FormData();
  const objectKeys = Object.keys(data);
  for(let i = 0; i < objectKeys.length; i++){
    formData.append(objectKeys[i], data[objectKeys[i]]);
  }
  return formData;
}