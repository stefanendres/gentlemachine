let watch = require('node-watch');
const { exec } = require('child_process');

console.log('👀 Watching ./frontend/*');
// frontend files
watch('frontend', { recursive: true }, function(event, name) {
  console.log('');
  console.log('✨ Receiving '+event+' at: '+name);
  let npm_build_command = null;

  if (name.slice(-3) == '.js' || name.slice(-4) == '.mjs') {
    npm_build_command = 'scripts';
  } else if (name.slice(-5) == '.scss') {
    npm_build_command = 'styles';
  }
  if (event == 'update' && npm_build_command) {
    exec('npm run build-'+npm_build_command, (err, stdout, stderr) => {
      if (err) {
        //some err occurred
        console.error('❗ Error while '+event+': '+name, err)
      } else {
       // the *entire* stdout and stderr (buffered)
       //console.log(`stdout: ${stdout}`);
       //console.log(`stderr: ${stderr}`);
       console.log('✅ Successfully built (initiated '+event+' at: '+name+')');
       /*
        * do upload here
        */
      }
    });
  }
});


console.log('👀 Watching ./*.php');
watch('./', { filter: /\.php$/ }, function(event, name) {
  console.log(' ');
  console.log('✨ Receiving '+event+' at: '+name);

  /*
   * do upload here
   */
});
