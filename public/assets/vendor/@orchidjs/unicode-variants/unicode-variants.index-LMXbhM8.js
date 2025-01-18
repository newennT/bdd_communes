/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/@orchidjs/unicode-variants@1.1.2/dist/esm/index.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
const t=t=>(t=t.filter(Boolean)).length<2?t[0]||"":1==o(t)?"["+t.join("")+"]":"(?:"+t.join("|")+")",e=t=>{if(!r(t))return t.join("");let e="",s=0;const n=()=>{s>1&&(e+="{"+s+"}")};return t.forEach(((r,o)=>{r!==t[o-1]?(n(),e+=r,s=1):s++})),n(),e},s=e=>{let s=Array.from(e);return t(s)},r=t=>new Set(t).size!==t.length,n=t=>(t+"").replace(/([\$\(\)\*\+\.\?\[\]\^\{\|\}\\])/gu,"\\$1"),o=t=>t.reduce(((t,e)=>Math.max(t,l(e))),0),l=t=>Array.from(t).length,a=t=>{if(1===t.length)return[[t]];let e=[];const s=t.substring(1);return a(s).forEach((function(s){let r=s.slice(0);r[0]=t.charAt(0)+r[0],e.push(r),r=s.slice(0),r.unshift(t.charAt(0)),e.push(r)})),e},h=[[0,65535]];let u,i;const d={},f={"/":"⁄∕",0:"߀",a:"ⱥɐɑ",aa:"ꜳ",ae:"æǽǣ",ao:"ꜵ",au:"ꜷ",av:"ꜹꜻ",ay:"ꜽ",b:"ƀɓƃ",c:"ꜿƈȼↄ",d:"đɗɖᴅƌꮷԁɦ",e:"ɛǝᴇɇ",f:"ꝼƒ",g:"ǥɠꞡᵹꝿɢ",h:"ħⱨⱶɥ",i:"ɨı",j:"ɉȷ",k:"ƙⱪꝁꝃꝅꞣ",l:"łƚɫⱡꝉꝇꞁɭ",m:"ɱɯϻ",n:"ꞥƞɲꞑᴎлԉ",o:"øǿɔɵꝋꝍᴑ",oe:"œ",oi:"ƣ",oo:"ꝏ",ou:"ȣ",p:"ƥᵽꝑꝓꝕρ",q:"ꝗꝙɋ",r:"ɍɽꝛꞧꞃ",s:"ßȿꞩꞅʂ",t:"ŧƭʈⱦꞇ",th:"þ",tz:"ꜩ",u:"ʉ",v:"ʋꝟʌ",vy:"ꝡ",w:"ⱳ",y:"ƴɏỿ",z:"ƶȥɀⱬꝣ",hv:"ƕ"};for(let t in f){let e=f[t]||"";for(let s=0;s<e.length;s++){let r=e.substring(s,s+1);d[r]=t}}const c=new RegExp(Object.keys(d).join("|")+"|[̀-ͯ·ʾʼ]","gu"),g=t=>{void 0===u&&(u=j(t||h))},p=(t,e="NFKD")=>t.normalize(e),b=t=>Array.from(t).reduce(((t,e)=>t+m(e)),""),m=t=>(t=p(t).toLowerCase().replace(c,(t=>d[t]||"")),p(t,"NFC"));function*w(t){for(const[e,s]of t)for(let t=e;t<=s;t++){let e=String.fromCharCode(t),s=b(e);s!=e.toLowerCase()&&(s.length>3||0!=s.length&&(yield{folded:s,composed:e,code_point:t}))}}const y=t=>{const e={},r=(t,r)=>{const o=e[t]||new Set,l=new RegExp("^"+s(o)+"$","iu");r.match(l)||(o.add(n(r)),e[t]=o)};for(let e of w(t))r(e.folded,e.folded),r(e.folded,e.composed);return e},j=e=>{const r=y(e),o={};let l=[];for(let t in r){let e=r[t];e&&(o[t]=s(e)),t.length>1&&l.push(n(t))}l.sort(((t,e)=>e.length-t.length));const a=t(l);return i=new RegExp("^"+a,"u"),o},x=(t,s=1)=>{let r=0;return t=t.map((t=>(u[t]&&(r+=t.length),u[t]||t))),r>=s?e(t):""},S=(e,s=1)=>(s=Math.max(s,e.length-1),t(a(e).map((t=>x(t,s))))),v=(s,r=!0)=>{let n=s.length>1?1:0;return t(s.map((t=>{let s=[];const o=r?t.length():t.length()-1;for(let e=0;e<o;e++)s.push(S(t.substrs[e]||"",n));return e(s)})))},z=(t,e)=>{for(const s of e){if(s.start!=t.start||s.end!=t.end)continue;if(s.substrs.join("")!==t.substrs.join(""))continue;let e=t.parts;const r=t=>{for(const s of e){if(s.start===t.start&&s.substr===t.substr)return!1;if(1!=t.length&&1!=s.length){if(t.start<s.start&&t.end>s.start)return!0;if(s.start<t.start&&s.end>t.start)return!0}}return!1};if(!(s.parts.filter(r).length>0))return!0}return!1};class A{parts;substrs;start;end;constructor(){this.parts=[],this.substrs=[],this.start=0,this.end=0}add(t){t&&(this.parts.push(t),this.substrs.push(t.substr),this.start=Math.min(t.start,this.start),this.end=Math.max(t.end,this.end))}last(){return this.parts[this.parts.length-1]}length(){return this.parts.length}clone(t,e){let s=new A,r=JSON.parse(JSON.stringify(this.parts)),n=r.pop();for(const t of r)s.add(t);let o=e.substr.substring(0,t-n.start),l=o.length;return s.add({start:n.start,end:n.start+l,length:l,substr:o}),s}}const C=t=>{g(),t=b(t);let e="",s=[new A];for(let r=0;r<t.length;r++){let n=t.substring(r).match(i);const o=t.substring(r,r+1),l=n?n[0]:null;let a=[],h=new Set;for(const t of s){const e=t.last();if(!e||1==e.length||e.end<=r)if(l){const e=l.length;t.add({start:r,end:r+e,length:e,substr:l}),h.add("1")}else t.add({start:r,end:r+1,length:1,substr:o}),h.add("2");else if(l){let s=t.clone(r,e);const n=l.length;s.add({start:r,end:r+n,length:n,substr:l}),a.push(s)}else h.add("3")}if(a.length>0){a=a.sort(((t,e)=>t.length()-e.length()));for(let t of a)z(t,s)||s.push(t)}else if(r>0&&1==h.size&&!h.has("3")){e+=v(s,!1);let t=new A;const r=s[0];r&&t.add(r.last()),s=[t]}}return e+=v(s,!0),e};export{m as _asciifold,b as asciifold,h as code_points,n as escape_regex,j as generateMap,y as generateSets,w as generator,C as getPattern,g as initialize,x as mapSequence,p as normalize,S as substringsToPattern,u as unicode_map};export default null;
