@extends('admin.layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagevue" style="display:none;" v-show="firsttime">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-area-chart"></i> Grafik</h3>
              </div>
            </div>
            <div class="clearfix"></div>
<div class="row tile_count" style="margin-bottom:-5px;"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
      <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count text-center">{{ $totaluser }}</div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-trophy"></i> Total Berita</span>
        <div class="count text-center">{{ $totalberita }}</div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-comment-o"></i> Total Komentar</span>
        <div class="count text-center">{{ $totalkomentar }}</div>
      </div>
</div></div></div></div>
<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
		{!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "loadusers"])  !!}
    <div class="item form-group">
      <div class="col-md-2 col-sm-2 col-xs-12">
        <div class="radio">
          <label>
            <input type="radio" class="flat" checked name="iCheck" id="bulanselect"> Bulan
          </label>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('filter',['01' =>'Januari'
        , '02' =>'Februari'
        , '03' =>'Maret'
        , '04' =>'April'
        , '05' =>'Mei'
        , '06' =>'Juni'
        , '07' =>'Juli'
        , '08' =>'Agustus'
        , '09' =>'September'
        , '10' =>'Oktober'
        , '11' =>'November'
        , '12' =>'Desember'
        ], $month, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'bulan', 'id' => 'bulananopt', '@change' => 'loadgrafik']) !!}
      </div>
    </div>
    <div class="item form-group">
      <div class="col-md-2 col-sm-2 col-xs-12">
        <div class="radio">
          <label>
            <input type="radio" class="flat" name="iCheck" id="tahunselect"> Tahun
          </label>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12">
        {!! Form::select('tahun', $optionyear, $yearnow, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'tahun', '@change' => 'loadgrafik']) !!}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12" v-show="selectgraph == 'tahunan'">
        Sampai Tahun
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12" v-show="selectgraph == 'tahunan'">
        {!! Form::select('tahunakhir',$optionyear, $maxyear, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'id' => 'tahunannopt', 'v-model' => 'tahunakhir', '@change' => 'loadgrafik']) !!}
      </div>
    </div>
		{!! Form::close() !!}
		</div>
	</div>
</div></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Grafik Jumlah Berita & Komentar</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div id="echart_line" style="height:350px;"></div>

      </div>
    </div>
  </div>
</div>
    </div>
</div>
        <!-- /page content -->
@endsection
@section('javascript')
<script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/fastclick/lib/fastclick.js"></script>
<script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/nprogress/nprogress.js"></script>
<script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/echarts/dist/echarts.min.js"></script>
<script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/echarts/map/js/world.js"></script>
<script>
var theme = {
        color: [
            'orange', 'green', 'red', 'yellow',
            'gray', 'blue', 'cyan', 'magenta'
        ],

        title: {
            itemGap: 8,
            textStyle: {
                fontWeight: 'bold'
            },
            subtextStyle: {
                color: 'black'
            },
        },

        dataRange: {
            color: ['#97b58d', '#1f610a']
        },

        toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
        },

        tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: '#408829',
                    type: 'dashed'
                },
                crossStyle: {
                    color: '#408829'
                },
                shadowStyle: {
                    color: 'rgba(200,200,200,0.3)'
                }
            }
        },

        dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
        },
        grid: {
            borderWidth: 0
        },

        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },

        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },
        timeline: {
            lineStyle: {
                color: '#408829'
            },
            controlStyle: {
                normal: {color: '#408829'},
                emphasis: {color: '#408829'}
            }
        },

        k: {
            itemStyle: {
                normal: {
                    color: '#68a54a',
                    color0: '#a9cba2',
                    lineStyle: {
                        width: 1,
                        color: '#408829',
                        color0: '#86b379'
                    }
                }
            }
        },
        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: '#ddd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                },
                emphasis: {
                    areaStyle: {
                        color: '#99d2dd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                }
            }
        },
        force: {
            itemStyle: {
                normal: {
                    linkStyle: {
                        strokeColor: '#408829'
                    }
                }
            }
        },
        chord: {
            padding: 4,
            itemStyle: {
                normal: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                },
                emphasis: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                }
            }
        },
        gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
                show: true,
                lineStyle: {
                    color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                    width: 8
                }
            },
            axisTick: {
                splitNumber: 10,
                length: 12,
                lineStyle: {
                    color: 'auto'
                }
            },
            axisLabel: {
                textStyle: {
                    color: 'auto'
                }
            },
            splitLine: {
                length: 18,
                lineStyle: {
                    color: 'auto'
                }
            },
            pointer: {
                length: '90%',
                color: 'auto'
            },
            title: {
                textStyle: {
                    color: '#333'
                }
            },
            detail: {
                textStyle: {
                    color: 'auto'
                }
            }
        },
        textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
        }
    };


var komponengraph = {
  title: {
    text:'',
    subtext:''
  },
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    x: 220,
    y: 40,
    data: ['Berita', 'Komentar']
  },
  toolbox: {
    show: true,
    feature: {
      magicType: {
        show: true,
        title: {
          line: 'Line',
          bar: 'Bar',
          stack: 'Stack',
          tiled: 'Tiled'
        },
        type: ['line', 'bar', 'stack', 'tiled']
      },
      restore: {
        show: true,
        title: "Restore"
      },
      saveAsImage: {
        show: true,
        title: "Save Image"
      }
    }
  },
  calculable: true,
  xAxis: [{
    type: 'category',
    boundaryGap: false,
    data: []
  }],
  yAxis: [{
    type: 'value'
  }],
  series: [{
    name: 'Komentar',
    type: 'line',
    smooth: true,
    itemStyle: {
      normal: {
        areaStyle: {
          type: 'default'
        }
      }
    },
    data: []
  },{
    name: 'Berita',
    type: 'line',
    smooth: true,
    itemStyle: {
      normal: {
        areaStyle: {
          type: 'default'
        }
      }
    },
    data: []
  }]
};

canajaxprocess = true;
vm = new Vue({
  el:'#pagevue',
  data: {
    firsttime: true,
    bulan:'{{ $month }}',
    tahun:'{{ $yearnow }}',
    tahunakhir: '{{ $maxyear }}',
    selectgraph:'bulanan',
  },
  methods: {
    loadgrafik: function() {
      elem = this;
      if (elem.selectgraph == 'bulanan') {
        elem.$http.post('{{ URL::to('admin-grafik-data') }}', { optselected : elem.selectgraph, yearselected : elem.tahun, monthselected : elem.bulan, _token: '{!! csrf_token() !!}' }).then(function(response){
          if (response.body.length > 0 && elem.selectgraph == 'bulanan') {
            var jsonObj = $.parseJSON(response.body);
            komponengraph.title.text = 'Grafik Bulanan';
            komponengraph.title.subtext = $('#bulananopt>option:selected').text()+' '+elem.tahun;
            komponengraph.xAxis[0].data = jsonObj.xaxixtitle;
            komponengraph.series[0].data = jsonObj.beritacount;
            komponengraph.series[1].data = jsonObj.komentarcount;
            echartLine = echarts.init(document.getElementById('echart_line'), theme);
            echartLine.setOption(komponengraph);
            console.log(echartLine);
          }
        });
      } else if (elem.selectgraph == 'tahunan') {
        elem.$http.post('{{ URL::to('admin-grafik-data') }}', { optselected : elem.selectgraph, yearselected : elem.tahun, lastyear : elem.tahunakhir, _token: '{!! csrf_token() !!}' }).then(function(response){
          if (response.body.length > 0 && elem.selectgraph == 'tahunan') {
            komponengraph.title.text = 'Grafik Tahunan';
            komponengraph.title.subtext = elem.tahun +' sampai '+ elem.tahunakhir;
            var jsonObj = $.parseJSON(response.body);
            komponengraph.xAxis[0].data = jsonObj.xaxixtitle;
            komponengraph.series[0].data = jsonObj.beritacount;
            komponengraph.series[1].data = jsonObj.komentarcount;
            echartLine = echarts.init(document.getElementById('echart_line'), theme);
            echartLine.setOption(komponengraph);
          }
        });
      }
    },
    showgrafikmonthly: function() {
      this.selectgraph = 'bulanan';
      this.loadgrafik();
    },
    showgrafikyearly: function() {
      this.selectgraph = 'tahunan';
      this.loadgrafik();
    }
  }
});

$('#bulanselect').on('ifClicked',function(e){
  vm.showgrafikmonthly();
});
$('#tahunselect').on('ifClicked',function(e){
  vm.showgrafikyearly();
});


vm.loadgrafik();
</script>
@endsection
