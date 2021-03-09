## Configuration

### main config

First, you have to create a file `conf.json` in the root dir. An example configuration is shown here:
```json
{
"data_dir":"./",
"icon_dir":"/sfto/rwicons/",
"root_dir":"https://riedler.wien/",
"dl_dir":"./resources/"
}
```
where both `icon_dir` and `root_dir` are used within the generated html, while `data_dir` and `dl_dir` are used to locate files containing the music data and files for downloading, respectively.

Example usage would be: `./data.json` for the main data file, `/sfto/rwicons/lmms.svg` for the lmms icon, and `https://riedler.wien/favicon.svg` for the favicon.  

Note that you *have* to end the paths with a trailing / and that remote locations are supported for `data_dir` to make testing in local environments easier.

### track data

Three files, namely `data.json`, `wishlist_data.json` and `rejected_data.json` are necessary. All three files are just arrays with one track per line. A file would look like this: (track data is replaced by `…`)

```json
[
[…],
[…],
[…]
]
```
Each file has a different structure for their track data.

*data.json*:  
`[type,title,state,requestor,date,links,note]`  
*wishlist_data.json* and *rejected_data.json*:  
`[type,title,requestor,link]`

`type` can be one of four values:

- `"o"`: An original work
- `"r"`: A remixed work
- `"ocomm"`: Am original commission
- `"rcomm"`: A requested remix

`title` is a string containing the title of the track  
`state` is an integer describing the current state of the track:

- `0`: Requested
- `1`: Planned
- `2`: Drafted
- `3`: Finished
- `4`: Uploaded  

`requestor` is a string containing the name of the requestor or an empty string if not applicaple.  
`date` is a string containing the release date of the track.  
`links` is a structure containing the links to various external platforms and optionally download files. An example would be:

```json
{"yt":"gDmAJO1eG0M","dl":{"banishing pepper":["opus","mp3"]}}
```
`note` is an optional string containing a note to the track  
`link` is a string containing the link to the original material

### linking config

linking_data.json is the file where the data is stored that stores how to access certain links. It's already in the repo, but you might want to modify it since some of the links are specific to me. The file's anatomy is as follows:
```json
{
service:[prefix,suffix,action],
…
}
``` 
`service` is the id of the service, such as `"sy"` for spotify.  
`prefix` is the url prefix without https (lbry:// links get handled automatically)
`suffix` is the url suffix  
`action` is a call to action, such as `"Watch on YouTube"`.