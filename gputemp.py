from bokeh.plotting import figure, show, save

data = []
with open('/var/hashcrack/temps-py.txt') as inf:
  for line in inf:
    data = eval( line )
    
x = list( range(1, len( data.get('fan_speed') )))

# create a new plot with a title and axis labels
p = figure(title="GPU state", x_axis_label="last n ticks", y_range=(0, 100), y_axis_label="degrees / percent")

# add multiple renderers
p.line(x, data.get('fan_speed') , legend_label="Fan (%)", line_color="blue", line_width=2)
p.line(x, data.get('temperature'), legend_label="Temp (deg C)", line_color="red", line_width=2)

save(p,"/var/hashcrack/temp.html")






